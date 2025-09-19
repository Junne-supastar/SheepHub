<?php
require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Usuario.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    // Valida campos antes de salvar ou atualizar
    private function validarCampos($dados, $isUpdate = false) {
        $erros = [];

        if (isset($dados['username']) && strlen($dados['username']) < 3) {
            $erros[] = "Usuário deve ter pelo menos 3 caracteres.";
        }

        if (isset($dados['email']) && !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros[] = "E-mail inválido.";
        }

        if (!$isUpdate && isset($dados['senha']) && strlen($dados['senha']) < 6) {
            $erros[] = "Senha deve ter pelo menos 6 caracteres.";
        }

        return $erros;
    }

    // Salvar novo usuário
    public function salvar($dados) {
        $erros = $this->validarCampos($dados);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        try {
            $hash = password_hash($dados['senha'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario
                    (nivel, id_status, username, email, senha, telefone, dt_criacao, data_nascimento)
                    VALUES
                    (:nivel, 1, :username, :email, :senha, :telefone, :dt_criacao, :data_nascimento)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'nivel'           => $dados['nivel'],
                'username'        => $dados['username'],
                'email'           => $dados['email'],
                'senha'           => $hash,
                'telefone'        => $dados['telefone'] ?? null,
                'dt_criacao'      => $dados['dt_criacao'] ?? date('Y-m-d'),
                'data_nascimento' => $dados['data_nascimento'] ?? null
            ]);

            return ['success' => true, 'id' => $this->conn->lastInsertId()];

        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao salvar usuário: " . $e->getMessage()]];
        }
    }

    // Atualizar usuário existente
    public function atualizar($idusuario, $dados) {
        $erros = $this->validarCampos($dados, true);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        try {
            $sql = "UPDATE usuario SET
                        nivel = :nivel,
                        username = :username,
                        email = :email,
                        telefone = :telefone,
                        data_nascimento = :data_nascimento";

            $params = [
                'nivel'           => $dados['nivel'],
                'username'        => $dados['username'],
                'email'           => $dados['email'],
                'telefone'        => $dados['telefone'] ?? null,
                'data_nascimento' => $dados['data_nascimento'] ?? null,
                'idusuario'       => $idusuario
            ];

            if (!empty($dados['senha'])) {
                $sql .= ", senha = :senha";
                $params['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
            }

            $sql .= " WHERE idusuario = :idusuario";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);

            return ['success' => true];

        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao atualizar usuário: " . $e->getMessage()]];
        }
    }

    // Alterar status (soft delete, ativar, bloquear)
    public function atualizarStatus($idusuario, $status) {
        try {
            $stmt = $this->conn->prepare("UPDATE usuario SET id_status = :status WHERE idusuario = :idusuario");
            $stmt->execute([
                'status' => $status,
                'idusuario' => $idusuario
            ]);
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao atualizar status: " . $e->getMessage()]];
        }
    }

    // Autenticar usuário
    public function autenticar($email, $senha) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE email = :email AND id_status = 1");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($senha, $usuario['senha'])) return $usuario;
        return false;
    }

    // Ativar usuário (id_status = 1)
    public function ativar($idusuario) {
        return $this->atualizarStatus($idusuario, 1);
    }

    // Bloquear usuário (id_status = 3)
    public function bloquear($idusuario) {
        return $this->atualizarStatus($idusuario, 3);
    }

    // Soft delete / desativar usuário (id_status = 4)
    public function deletar($idusuario) {
        return $this->atualizarStatus($idusuario, 4);
    }

    // Listar usuários
    public function listar($inicio = null, $quantidade = null) {
        $sql = "SELECT * FROM usuario";
        if ($inicio !== null && $quantidade !== null) {
            $sql .= " LIMIT :inicio, :quantidade";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':inicio', (int)$inicio, PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', (int)$quantidade, PDO::PARAM_INT);
        } else {
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar usuário por ID
    public function buscarPorId($idusuario) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE idusuario = :idusuario");
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
