<?php

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/UsuarioInstituicao.php';


class UsuarioInstituicaoController {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    // Valida os dados antes de salvar ou atualizar
    private function validarCampos($dados, $isUpdate = false) {
        $erros = [];

        if (isset($dados['nome_instituicao']) && strlen($dados['nome_instituicao']) < 3) {
            $erros[] = "Usuário deve ter pelo menos 3 caracteres.";
        }

        if (isset($dados['email_instituicao']) && !filter_var($dados['email_instituicao'], FILTER_VALIDATE_EMAIL)) {
            $erros[] = "E-mail inválido.";
        }

        if (!$isUpdate && isset($dados['senha_instituicao']) && strlen($dados['senha_instituicao']) < 6) {
            $erros[] = "Senha deve ter pelo menos 6 caracteres.";
        }

        if (isset($dados['cnpj']) && !preg_match('/^[0-9]{14}$/', $dados['cnpj'])) {
            $erros[] = "CNPJ inválido (use apenas números, 14 dígitos).";
        }

        return $erros;
    }

    // Salvar nova instituição
    public function salvar($dados) {
        $erros = $this->validarCampos($dados);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        try {
            $hash = password_hash($dados['senha_instituicao'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario_instituicao
                    (nivel, id_status, cnpj, email_instituicao, senha_instituicao, telefone_instituicao, descricao, nome_instituicao, dt_criacao_instituicao)
                    VALUES
                    (:nivel, :id_status, :cnpj, :email_instituicao, :senha_instituicao, :telefone_instituicao, :descricao, :nome_instituicao, :dt_criacao_instituicao)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'nivel'                 => $dados['nivel'],
                'id_status'             => 1,
                'cnpj'                  => $dados['cnpj'],
                'email_instituicao'     => $dados['email_instituicao'],
                'senha_instituicao'     => $hash,
                'telefone_instituicao'  => $dados['telefone_instituicao'] ?? null,
                'descricao'             => $dados['descricao'] ?? null,
                'nome_instituicao'      => $dados['nome_instituicao'] ?? null,
                'dt_criacao_instituicao'=> $dados['dt_criacao_instituicao'] ?? date('Y-m-d')
            ]);

            return ['success' => true, 'id' => $this->conn->lastInsertId()];

        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao salvar instituição: " . $e->getMessage()]];
        }
    }

    // Atualizar instituição existente
    public function atualizar($idusuario_instituicao, $dados) {
        $erros = $this->validarCampos($dados, true);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        try {
            $sql = "UPDATE usuario_instituicao SET
                        nivel = :nivel,
                        cnpj = :cnpj,
                        email_instituicao = :email_instituicao,
                        telefone_instituicao = :telefone_instituicao,
                        descricao = :descricao,
                        nome_instituicao = :nome_instituicao";

            $params = [
                'nivel'                => $dados['nivel'],
                'cnpj'                 => $dados['cnpj'],
                'email_instituicao'    => $dados['email_instituicao'],
                'telefone_instituicao' => $dados['telefone_instituicao'] ?? null,
                'descricao'            => $dados['descricao'] ?? null,
                'nome_instituicao'     => $dados['nome_instituicao'] ?? null,
                'idusuario_instituicao'=> $idusuario_instituicao
            ];

            if (!empty($dados['senha_instituicao'])) {
                $sql .= ", senha_instituicao = :senha_instituicao";
                $params['senha_instituicao'] = password_hash($dados['senha_instituicao'], PASSWORD_DEFAULT);
            }

            $sql .= " WHERE idusuario_instituicao = :idusuario_instituicao";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);

            return ['success' => true];

        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao atualizar instituição: " . $e->getMessage()]];
        }
    }

    // Soft delete ou mudança de status
    public function atualizarStatus($idusuario_instituicao, $status) {
        try {
            $stmt = $this->conn->prepare("UPDATE usuario_instituicao SET id_status = :status WHERE idusuario_instituicao = :idusuario_instituicao");
            $stmt->execute([
                'status' => $status,
                'idusuario_instituicao' => $idusuario_instituicao
            ]);
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao atualizar status: " . $e->getMessage()]];
        }
    }
    public function ativar($idusuario_instituicao) {
        return $this->atualizarStatus($idusuario_instituicao, 1);
    }

    // Bloquear usuário (id_status = 3)
    public function bloquear($idusuario_instituicao) {
        return $this->atualizarStatus($idusuario_instituicao, 2);
    }

    // Soft delete / desativar usuário (id_status = 4)
    public function deletar($idusuario_instituicao) {
        return $this->atualizarStatus($idusuario_instituicao, 4);
    }

    // Listar todas as instituições
    public function listar($inicio = null, $quantidade = null) {
        $sql = "SELECT * FROM usuario_instituicao";
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


    // Buscar instituição por ID
    public function buscarPorId($idusuario_instituicao) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario_instituicao WHERE idusuario_instituicao = :id");
        $stmt->execute(['id' => $idusuario_instituicao]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
