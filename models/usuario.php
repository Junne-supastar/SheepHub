<?php

require_once __DIR__ . '/../config/Conexao.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function listar($inicio = null, $quantidade = null) {
        $sql = "SELECT u.*, s.nome AS nome_status
            FROM usuario u
            JOIN status s ON u.id_status = s.id_status";
            
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

    public function existeUsername($username = null, $ignoreId = null) {
        if (empty($username)) return false;
        $sql = "SELECT COUNT(*) FROM usuario WHERE username = :username";
        if ($ignoreId) $sql .= " AND idusuario != :idusuario";
        $stmt = $this->conn->prepare($sql);
        $params = ['username' => $username];
        if ($ignoreId) $params['idusuario'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    public function existeEmail($email = null, $ignoreId = null) {
        if (empty($email)) return false;
        $sql = "SELECT COUNT(*) FROM usuario WHERE email = :email";
        if ($ignoreId) $sql .= " AND idusuario != :idusuario";
        $stmt = $this->conn->prepare($sql);
        $params = ['email' => $email];
        if ($ignoreId) $params['idusuario'] = $ignoreId;
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

   public function salvar($dados) {
    $erros = $this->validarCampos($dados);
    if (!empty($erros)) return ['success' => false, 'errors' => $erros];

    // Mantenha as validações de unicidade de username e email.
    if ($this->existeUsername($dados['username'])) return ['success' => false, 'errors' => ["Usuário já cadastrado!"]];
    if ($this->existeEmail($dados['email'])) return ['success' => false, 'errors' => ["E-mail já cadastrado!"]];

    try {
        $hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario (nivel, id_status, email, senha, nome, username, data_nascimento, dt_criacao)
        VALUES (:nivel, :id_status, :email, :senha, :nome, :username, :data_nascimento, :dt_criacao)";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            'nivel' => $dados['nivel'],
            'id_status' => 1,
            'email' => $dados['email'],
            'senha' => $hash,
            'nome' => $dados['nome'],
            'username' => $dados['username'],
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'dt_criacao' => date('Y-m-d H:i:s'),
        ]);
        // Retorna o ID do novo usuário após o sucesso
        return ['success' => true, 'idusuario' => $this->conn->lastInsertId()];

    } catch (PDOException $e) {
        // Em caso de erro, retorna a mensagem de erro e 'idusuario' como null
        return ['success' => false, 'errors' => ["Erro ao salvar Usuário: " . $e->getMessage()], 'idusuario' => null];
    }
}
    

    public function atualizar($idusuario, $dados) {
        $erros = $this->validarCampos($dados, true);
        if (!empty($erros)) return ['success' => false, 'errors' => $erros];

        if (!empty($dados['username']) && $this->existeUsername($dados['username'], $idusuario)) return ['success' => false, 'errors' => ["Usuário já cadastrado!"]];
        if (!empty($dados['email']) && $this->existeEmail($dados['email'], $idusuario)) return ['success' => false, 'errors' => ["E-mail já cadastrado!"]];

        try {
            $sql = "UPDATE usuario SET nivel = :nivel, email = :email, nome = :nome, username = :username, data_nascimento = :data_nascimento";
            $params = [
                'nivel' => $dados['nivel'],
                'email' => $dados['email'],
                'nome' => $dados['nome'],
                'username' => $dados['username'] ?? null,
                'data_nascimento' => $dados['data_nascimento'] ?? null,
                'idusuario' => $idusuario
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

    public function deletar($idusuario) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM usuario WHERE idusuario = :idusuario");
            $stmt->execute(['idusuario' => $idusuario]);
            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'errors' => ["Erro ao deletar usuário: " . $e->getMessage()]];
        }
    }

    public function atualizarStatus($idusuario, $status) {
        if(!in_array($status, [1, 2])) return ['success' => false, 'errors' => ['Status inválido']];
         try {
        $stmt = $this->conn->prepare("UPDATE usuario SET id_status = :status WHERE idusuario = :idusuario");
        $stmt->execute(['status' => $status, 'idusuario' => $idusuario]);
        return ['success' => true];
    } catch(PDOException $e) {
        return ['success' => false, 'errors' => ["Erro ao atualizar status: ".$e->getMessage()]];
    }
    }

public function autenticar($email, $senha) {
    $sql = "SELECT * FROM usuario WHERE email = :email AND id_status = 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        return $usuario;
    }
    return false;
}

}
