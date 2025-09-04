<?php
require_once __DIR__ . '/../config/Conexao.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function listar($inicio = null, $quantidade = null) {
        if ($inicio !== null && $quantidade !== null) {
            $sql = "SELECT * FROM usuario LIMIT :inicio, :quantidade";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':inicio', (int)$inicio, PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', (int)$quantidade, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM usuario";
            $stmt = $this->conn->prepare($sql);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarTotal() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM usuario");
        $stmt->execute();
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE id_usu = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        try {
            if (isset($dados['id_usu']) && $dados['id_usu']) { //if (!empty($dados['id_usu'])) {
                // Atualização (sem alteração de senha aqui)
                $sql = "UPDATE usuario SET email = :email, nivel = :nivel WHERE id_usu = :id_usu";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([
                    'email' => $dados['email'],
                    'nivel' => $dados['nivel'],
                    'id_usu' => $dados['id_usu']
                ]);
            } else {
                // Novo cadastro
                $hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO usuario (email, senha, nivel) VALUES (:email, :senha, :nivel)";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([
                    'email' => $dados['email'],
                    'senha' => $hash,
                    'nivel' => $dados['nivel']
                ]);
            }
        } catch (PDOException $e) {
            // Verifica se o erro é de entrada duplicada UNIQUE (código 1062)
            if (str_contains($e->getMessage(), '1062')) {
                throw new Exception("Impossível Salvar: Este USUÁRIO (e-mail) já está cadastrado!");
            } else {
                throw new Exception("Erro ao salvar usuário: " . $e->getMessage());
            }
        }
    }
        
    public function registrar($email, $senha) {
        try{
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuario (email, senha, nivel, ativo) VALUES (:email, :senha, '3', 1)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute(['email' => $email, 'senha' => $hash]);
        } catch (PDOException $e) {
            // Verifica se o erro é de entrada duplicada UNIQUE (código 1062)
            if (str_contains($e->getMessage(), '1062')) {
                $_SESSION['erro'] = "Impossível Registrar: Este USUÁRIO (e-mail) já está cadastrado!";
            } else {
                $_SESSION['erro'] = "Erro ao salvar usuário: " . $e->getMessage();
            }
        } catch (Throwable $e) {
            // Erro inesperado → erroException
            $_SESSION['erro'] = 'Ocorreu um erro inesperado. Tente novamente mais tarde.';
            error_log($e->getMessage()); // para o log do sistema
        }
    }

    public function autenticar($email, $senha) {
        $sql = "SELECT * FROM usuario WHERE email = :email AND ativo = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }
    
    public function bloquear($id) {
        $stmt = $this->conn->prepare("UPDATE usuario SET ativo = 0 WHERE id_usu = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function ativar($id) {
        $stmt = $this->conn->prepare("UPDATE usuario SET ativo = 1 WHERE id_usu = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>