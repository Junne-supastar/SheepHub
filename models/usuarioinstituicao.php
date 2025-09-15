<?php
require_once __DIR__ . '/../config/Conexao.php';

class UsuarioInstituicao {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    // Verifica se o username já existe
    public function existeUsername($username, $ignoreId = null) {
        $sql = "SELECT COUNT(*) FROM usuario_instituicao WHERE username_instituicao = :username_instituicao";
        if ($ignoreId) $sql .= " AND idusuario_instituicao != :id";
        $stmt = $this->conn->prepare($sql);
        $params = ['username_instituicao' => $username];
        if ($ignoreId) $params['id'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // Verifica se o email já existe
    public function existeEmail($email, $ignoreId = null) {
        $sql = "SELECT COUNT(*) FROM usuario_instituicao WHERE email_instituicao = :email_instituicao";
        if ($ignoreId) $sql .= " AND idusuario_instituicao != :id";
        $stmt = $this->conn->prepare($sql);
        $params = ['email_instituicao' => $email];
        if ($ignoreId) $params['id'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // Verifica se o CNPJ já existe
    public function existeCnpj($cnpj, $ignoreId = null) {
        $sql = "SELECT COUNT(*) FROM usuario_instituicao WHERE cnpj = :cnpj";
        if ($ignoreId) $sql .= " AND idusuario_instituicao != :id";
        $stmt = $this->conn->prepare($sql);
        $params = ['cnpj' => $cnpj];
        if ($ignoreId) $params['id'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // Busca instituição pelo ID
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario_instituicao WHERE idusuario_instituicao = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lista instituições com ou sem paginação
    public function listar($inicio = null, $quantidade = null) {
        if ($inicio !== null && $quantidade !== null) {
            $sql = "SELECT * FROM usuario_instituicao LIMIT :inicio, :quantidade";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':inicio', (int)$inicio, PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', (int)$quantidade, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM usuario_instituicao";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Salva uma nova instituição
    public function salvar($dados) {
    $erros = $this->validarCampos($dados);
    if (!empty($erros)) return ['success' => false, 'errors' => $erros];

    // Verificações só se os campos existirem
    if (!empty($dados['username_instituicao']) && $this->existeUsername($dados['username_instituicao'])) {
        return ['success' => false, 'errors' => ["Usuário já cadastrado!"]];
    }
    if (!empty($dados['email_instituicao']) && $this->existeEmail($dados['email_instituicao'])) {
        return ['success' => false, 'errors' => ["E-mail já cadastrado!"]];
    }
    if (!empty($dados['cnpj']) && $this->existeCnpj($dados['cnpj'])) {
        return ['success' => false, 'errors' => ["CNPJ já cadastrado!"]];
    }

    try {
        $hash = !empty($dados['senha_instituicao']) ? password_hash($dados['senha_instituicao'], PASSWORD_DEFAULT) : null;

        $campos = ['nivel', 'cep', 'id_status', 'cnpj', 'descricao', 'email_instituicao', 'senha_instituicao', 'telefone_instituicao', 'dt_criacao_instituicao'];
        $valores = [':nivel', ':cep', ':id_status', ':cnpj', ':descricao', ':email_instituicao', ':senha_instituicao', ':telefone_instituicao', ':dt_criacao_instituicao'];

        $params = [
            'nivel'                 => $dados['nivel'],
            'cep'                   => $dados['cep'] ?? null,
            'id_status'             => $dados['id_status'] ?? 1,
            'cnpj'                  => $dados['cnpj'] ?? null,
            'descricao'             => $dados['descricao'] ?? null,
            'email_instituicao'     => $dados['email_instituicao'] ?? null,
            'senha_instituicao'     => $hash,
            'telefone_instituicao'  => $dados['telefone_instituicao'] ?? null,
            'dt_criacao_instituicao'=> date('Y-m-d')
        ];

        if (!empty($dados['username_instituicao'])) {
            $campos[] = 'username_instituicao';
            $valores[] = ':username_instituicao';
            $params['username_instituicao'] = $dados['username_instituicao'];
        }

        $sql = "INSERT INTO usuario_instituicao (" . implode(',', $campos) . ") VALUES (" . implode(',', $valores) . ")";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return ['success' => true, 'id' => $this->conn->lastInsertId()];

    } catch (PDOException $e) {
        error_log("Erro ao salvar instituição: " . $e->getMessage());
        return ['success' => false, 'errors' => ["Erro ao salvar instituição: " . $e->getMessage()]];
    }
}


    // Atualiza dados de uma instituição
    public function atualizar($id, $dados) {
        $erros = $this->validarCampos($dados);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        if ($this->existeUsername($dados['username_instituicao'], $id)) return ['success' => false, 'errors' => ["Usuário já cadastrado!"]];
        if ($this->existeEmail($dados['email_instituicao'], $id)) return ['success' => false, 'errors' => ["E-mail já cadastrado!"]];
        if ($this->existeCnpj($dados['cnpj'], $id)) return ['success' => false, 'errors' => ["CNPJ já cadastrado!"]];

        try {
            $sql = "UPDATE usuario_instituicao SET
                        nivel = :nivel,
                        cep = :cep,
                        id_status = :id_status,
                        cnpj = :cnpj,
                        email_instituicao = :email_instituicao,
                        telefone_instituicao = :telefone_instituicao,
                        username_instituicao = :username_instituicao
                    WHERE idusuario_instituicao = :id";
            
            $params = [
                'nivel'                 => $dados['nivel'],
                'cep'                   => $dados['cep'],
                'id_status'             => $dados['id_status'] ?? 1,
                'cnpj'                  => $dados['cnpj'],
                'email_instituicao'     => $dados['email_instituicao'],
                'telefone_instituicao'  => $dados['telefone_instituicao'],
                'username_instituicao'  => $dados['username_instituicao'],
                'id'                    => $id
            ];

            if (!empty($dados['senha_instituicao'])) {
                $params['senha_instituicao'] = password_hash($dados['senha_instituicao'], PASSWORD_DEFAULT);
                $sql = str_replace(
                    'WHERE idusuario_instituicao = :id',
                    ', senha_instituicao = :senha_instituicao WHERE idusuario_instituicao = :id',
                    $sql
                );
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return ['success' => true];
        } catch (PDOException $e) {
            error_log("Erro ao atualizar instituição: " . $e->getMessage());
            return ['success' => false, 'errors' => ["Erro ao atualizar instituição."]];
        }
    }

    // Deleta uma instituição
    public function deletar($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM usuario_instituicao WHERE idusuario_instituicao = :id");
            $stmt->execute(['id' => $id]);
            return ['success' => true];
        } catch (PDOException $e) {
            error_log("Erro ao deletar instituição: " . $e->getMessage());
            return ['success' => false, 'errors' => ["Erro ao deletar instituição."]];
        }
    }

    // Valida os campos antes de salvar/atualizar
    private function validarCampos($dados) {
        $erros = [];

        if (empty($dados['username_instituicao']) || strlen($dados['username_instituicao']) < 3) {
            $erros[] = "O campo 'Usuário' é obrigatório e deve ter pelo menos 3 caracteres.";
        }
        if (empty($dados['cnpj']) || !preg_match('/^\d{14}$/', preg_replace('/\D/', '', $dados['cnpj']))) {
            $erros[] = "O campo 'CNPJ' é obrigatório e deve conter 14 dígitos numéricos.";
        }
        if (empty($dados['email_instituicao']) || !filter_var($dados['email_instituicao'], FILTER_VALIDATE_EMAIL)) {
            $erros[] = "O campo 'E-mail' é obrigatório e deve ser um e-mail válido.";
        }
        if (!empty($dados['senha_instituicao']) && strlen($dados['senha_instituicao']) < 6) {
            $erros[] = "O campo 'Senha' deve ter pelo menos 6 caracteres.";
        }
        if (empty($dados['telefone_instituicao']) || !preg_match('/^\d{10,11}$/', preg_replace('/\D/', '', $dados['telefone_instituicao']))) {
            $erros[] = "O campo 'Telefone' é obrigatório e deve conter entre 10 e 11 dígitos numéricos.";
        }
        if (empty($dados['cep']) || !preg_match('/^\d{8}$/', preg_replace('/\D/', '', $dados['cep']))) {
            $erros[] = "O campo 'CEP' é obrigatório e deve conter 8 dígitos numéricos.";
        }

        return $erros;
    }
}
