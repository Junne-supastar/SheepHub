<?php
require_once __DIR__ . '/../config/Conexao.php';

class UsuarioInstituicao {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    // Listar instituições
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

    // Buscar instituição pelo ID
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario_instituicao WHERE idusuario_instituicao = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar se username já existe
    public function existeUsername($username = null, $ignoreId = null) {
        if (empty($username)) return false;
        $sql = "SELECT COUNT(*) FROM usuario_instituicao WHERE username_instituicao = :username";
        if ($ignoreId) $sql .= " AND idusuario_instituicao != :id";
        $stmt = $this->conn->prepare($sql);
        $params = ['username' => $username];
        if ($ignoreId) $params['id'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // Verificar se e-mail já existe
    public function existeEmail($email = null, $ignoreId = null) {
        if (empty($email)) return false;
        $sql = "SELECT COUNT(*) FROM usuario_instituicao WHERE email_instituicao = :email";
        if ($ignoreId) $sql .= " AND idusuario_instituicao != :id";
        $stmt = $this->conn->prepare($sql);
        $params = ['email' => $email];
        if ($ignoreId) $params['id'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // Verificar se CNPJ já existe
    public function existeCnpj($cnpj = null, $ignoreId = null) {
        if (empty($cnpj)) return false;
        $sql = "SELECT COUNT(*) FROM usuario_instituicao WHERE cnpj = :cnpj";
        if ($ignoreId) $sql .= " AND idusuario_instituicao != :id";
        $stmt = $this->conn->prepare($sql);
        $params = ['cnpj' => $cnpj];
        if ($ignoreId) $params['id'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // Validar campos
    private function validarCampos($dados, $isUpdate = false) {
        $erros = [];
        if (isset($dados['username_instituicao']) && strlen($dados['username_instituicao']) < 3)
            $erros[] = "Usuário deve ter pelo menos 3 caracteres.";
        if (isset($dados['email_instituicao']) && !filter_var($dados['email_instituicao'], FILTER_VALIDATE_EMAIL))
            $erros[] = "E-mail inválido.";
        if (isset($dados['cnpj']) && !preg_match('/^\d{14}$/', preg_replace('/\D/', '', $dados['cnpj'])))
            $erros[] = "CNPJ deve ter 14 dígitos.";
        if (!$isUpdate && isset($dados['senha_instituicao']) && strlen($dados['senha_instituicao']) < 6)
            $erros[] = "Senha deve ter pelo menos 6 caracteres.";
        return $erros;
    }

    // Salvar nova instituição
    public function salvar($dados) {
        $erros = $this->validarCampos($dados);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        if (!empty($dados['username_instituicao']) && $this->existeUsername($dados['username_instituicao'])) return ['success' => false, 'errors' => ["Usuário já cadastrado!"]];
        if (!empty($dados['email_instituicao']) && $this->existeEmail($dados['email_instituicao'])) return ['success' => false, 'errors' => ["E-mail já cadastrado!"]];
        if (!empty($dados['cnpj']) && $this->existeCnpj($dados['cnpj'])) return ['success' => false, 'errors' => ["CNPJ já cadastrado!"]];

        try {
            $hash = !empty($dados['senha_instituicao']) ? password_hash($dados['senha_instituicao'], PASSWORD_DEFAULT) : null;
            $sql = "INSERT INTO usuario_instituicao 
                    (nivel, id_status, username_instituicao, email_instituicao, senha_instituicao, cnpj, telefone_instituicao, dt_criacao_instituicao)
                    VALUES
                    (:nivel, :id_status, :username_instituicao, :email_instituicao, :senha_instituicao, :cnpj, :telefone_instituicao, :dt_criacao_instituicao)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'nivel' => $dados['nivel'],
                'id_status' => $dados['id_status'] ?? 1,
                'username_instituicao' => $dados['username_instituicao'],
                'email_instituicao' => $dados['email_instituicao'],
                'senha_instituicao' => $hash,
                'cnpj' => $dados['cnpj'],
                'telefone_instituicao' => $dados['telefone_instituicao'] ?? null,
                'dt_criacao_instituicao' => $dados['dt_criacao_instituicao'] ?? date('Y-m-d')
            ]);
            return ['success' => true, 'id' => $this->conn->lastInsertId()];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao salvar instituição: " . $e->getMessage()]];
        }
    }

    // Atualizar instituição
    public function atualizar($id, $dados) {
        $erros = $this->validarCampos($dados, true);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        if ($this->existeUsername($dados['username_instituicao'], $id)) return ['success' => false, 'errors' => ["Usuário já cadastrado!"]];
        if ($this->existeEmail($dados['email_instituicao'], $id)) return ['success' => false, 'errors' => ["E-mail já cadastrado!"]];
        if ($this->existeCnpj($dados['cnpj'], $id)) return ['success' => false, 'errors' => ["CNPJ já cadastrado!"]];

        try {
            $sql = "UPDATE usuario_instituicao SET 
                        nivel = :nivel,
                        username_instituicao = :username_instituicao,
                        email_instituicao = :email_instituicao,
                        cnpj = :cnpj,
                        telefone_instituicao = :telefone_instituicao,
                        id_status = :id_status";
            $params = [
                'nivel' => $dados['nivel'],
                'username_instituicao' => $dados['username_instituicao'],
                'email_instituicao' => $dados['email_instituicao'],
                'cnpj' => $dados['cnpj'],
                'telefone_instituicao' => $dados['telefone_instituicao'] ?? null,
                'id_status' => $dados['id_status'] ?? 1,
                'id' => $id
            ];

            if (!empty($dados['senha_instituicao'])) {
                $sql .= ", senha_instituicao = :senha_instituicao";
                $params['senha_instituicao'] = password_hash($dados['senha_instituicao'], PASSWORD_DEFAULT);
            }

            $sql .= " WHERE idusuario_instituicao = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao atualizar instituição: " . $e->getMessage()]];
        }
    }

    // Deletar instituição
    public function deletar($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM usuario_instituicao WHERE idusuario_instituicao = :id");
            $stmt->execute(['id' => $id]);
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao deletar instituição: " . $e->getMessage()]];
        }
    }

    // Atualizar status (ativar/bloquear)
    public function atualizarStatus($id, $status) {
        try {
            $stmt = $this->conn->prepare("UPDATE usuario_instituicao SET id_status = :status WHERE idusuario_instituicao = :id");
            $stmt->execute(['status' => $status, 'id' => $id]);
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao atualizar status: " . $e->getMessage()]];
        }
    }
}
