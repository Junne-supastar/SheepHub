<?php
require_once __DIR__ . '/../config/Conexao.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

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

    public function contarTotal() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM usuario");
        $stmt->execute();
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function buscarPorId($idusuario) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE idusuario = :idusuario");
        $stmt->execute(['idusuario' => $idusuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existeUsername($username = null, $ignoreId = null) {
        if (!$username) return false; // Ignora se não houver username
        $sql = "SELECT COUNT(*) FROM usuario WHERE username = :username";
        if ($ignoreId) $sql .= " AND idusuario != :idusuario";
        $stmt = $this->conn->prepare($sql);
        $params = ['username' => $username];
        if ($ignoreId) $params['idusuario'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    public function existeEmail($email = null, $ignoreId = null) {
        if (!$email) return false; // Ignora se não houver email
        $sql = "SELECT COUNT(*) FROM usuario WHERE email = :email";
        if ($ignoreId) $sql .= " AND idusuario != :idusuario";
        $stmt = $this->conn->prepare($sql);
        $params = ['email' => $email];
        if ($ignoreId) $params['idusuario'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    private function validarCampos($dados, $isUpdate = false) {
        $erros = [];
        if (isset($dados['username']) && strlen($dados['username']) < 3)
            $erros[] = "Usuário deve ter pelo menos 3 caracteres.";
        if (isset($dados['email']) && !filter_var($dados['email'], FILTER_VALIDATE_EMAIL))
            $erros[] = "E-mail inválido.";
        if (!$isUpdate && isset($dados['senha']) && strlen($dados['senha']) < 6)
            $erros[] = "Senha deve ter pelo menos 6 caracteres.";
        return $erros;
    }

    public function salvar($dados) {
        $erros = $this->validarCampos($dados);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        if (!empty($dados['username']) && $this->existeUsername($dados['username']))
            return ['success' => false, 'errors' => ["Usuário já cadastrado!"]];
        if (!empty($dados['email']) && $this->existeEmail($dados['email']))
            return ['success' => false, 'errors' => ["E-mail já cadastrado!"]];

        try {
            $hash = !empty($dados['senha']) ? password_hash($dados['senha'], PASSWORD_DEFAULT) : null;
            $sql = "INSERT INTO usuario 
                (nivel, id_status, email, senha, telefone, data_nascimento, username, dt_criacao, cep) 
                VALUES (:nivel, :id_status, :email, :senha, :telefone, :data_nascimento, :username, :dt_criacao, :cep)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'nivel' => $dados['nivel'],
                'id_status' => $dados['id_status'] ?? 1,
                'email' => $dados['email'] ?? null,
                'senha' => $hash,
                'telefone' => $dados['telefone'] ?? null,
                'data_nascimento' => $dados['data_nascimento'] ?? null,
                'username' => $dados['username'] ?? null,
                'dt_criacao' => $dados['dt_criacao'] ?? date('Y-m-d'),
                'cep' => $dados['cep'] ?? null
            ]);
            return ['success' => true, 'id' => $this->conn->lastInsertId()];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao salvar usuário: " . $e->getMessage()]];
        }
    }

    public function atualizar($idusuario, $dados) {
        $erros = $this->validarCampos($dados, true);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        if (!empty($dados['username']) && $this->existeUsername($dados['username'], $idusuario))
            return ['success' => false, 'errors' => ["Usuário já cadastrado!"]];
        if (!empty($dados['email']) && $this->existeEmail($dados['email'], $idusuario))
            return ['success' => false, 'errors' => ["E-mail já cadastrado!"]];

        try {
            $sql = "UPDATE usuario SET
                        email = :email,
                        username = :username,
                        nivel = :nivel,
                        telefone = :telefone,
                        data_nascimento = :data_nascimento
                    WHERE idusuario = :idusuario";
            $params = [
                'email' => $dados['email'] ?? null,
                'username' => $dados['username'] ?? null,
                'nivel' => $dados['nivel'],
                'telefone' => $dados['telefone'] ?? null,
                'data_nascimento' => $dados['data_nascimento'] ?? null,
                'idusuario' => $idusuario
            ];
            if (!empty($dados['senha'])) {
                $params['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
                $sql = str_replace(
                    'WHERE idusuario = :idusuario',
                    ', senha = :senha WHERE idusuario = :idusuario',
                    $sql
                );
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao atualizar usuário: " . $e->getMessage()]];
        }
    }

    public function deletar($idusuario) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM usuario WHERE idusuario = :idusuario");
            $stmt->execute(['idusuario' => $idusuario]);
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao deletar usuário: " . $e->getMessage()]];
        }
    }

    public function autenticar($email, $senha) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE email = :email AND id_status = 1");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($senha, $usuario['senha'])) return $usuario;
        return false;
    }

    public function bloquear($idusuario) {
        $stmt = $this->conn->prepare("UPDATE usuario SET id_status = 4 WHERE idusuario = :idusuario");
        return $stmt->execute(['idusuario' => $idusuario]);
    }

    public function ativar($idusuario) {
        $stmt = $this->conn->prepare("UPDATE usuario SET id_status = 1 WHERE idusuario = :idusuario");
        return $stmt->execute(['idusuario' => $idusuario]);
    }
}
