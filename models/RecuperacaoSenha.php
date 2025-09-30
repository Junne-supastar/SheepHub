<?php
// Inclui o arquivo de configuração do banco de dados e conexão
require_once __DIR__ . '/../config/Conexao.php';

/**
 * Classe RecuperacaoSenha
 * Responsável por gerenciar tokens de recuperação de senha
 */

class RecuperacaoSenha {
    private $conn; // Armazena a conexão com o banco de dados

    // Construtor: cria a conexão ao instanciar a classe
    public function __construct() {
        $this->conn = Conexao::getConexao(); // Obtém a conexão PDO
    }

    /**
     * Cria um token de recuperação para o e-mail informado
     * @param string $email Email do usuário
     * @return string|false Retorna o token gerado ou false se usuário não existir
     */
    public function criarToken($email) {
        try {
            // Busca o usuário pelo email
            $stmt = $this->conn->prepare("SELECT idusuario FROM usuario WHERE email = :email AND id_status = 1");
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) return false; // Se não encontrou usuário ativo, retorna false

            // Gera um token aleatório de 8 caracteres
            $token = substr(bin2hex(random_bytes(4)), 0, 8); // 4 bytes = 8 caracteres hexadecimais

            // Define a validade do token (1 hora a partir de agora)
            $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Insere ou atualiza o token na tabela recuperacao_senha
$stmt = $this->conn->prepare("
    INSERT INTO recuperacao_senha (usuario_idusuario, token, expira)
    VALUES (:idusuario, :token, :expira)
    ON DUPLICATE KEY UPDATE 
        token = VALUES(token),
        expira = VALUES(expira)
");
$stmt->execute([
    'idusuario' => $usuario['idusuario'],
    'token' => $token,
    'expira' => $expira
]);
            return $token; // Retorna o token gerado

        } catch (PDOException $e) {
            // Caso ocorra erro de banco
            $_SESSION['erro'] = "Erro ao gerar token: " . $e->getMessage();
            return false;
        } catch (Throwable $e) {
            // Erro inesperado
            $_SESSION['erro'] = "Erro inesperado. Tente novamente mais tarde.";
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Valida se um token é válido (existe e não expirou)
     * @param string $token Token fornecido pelo usuário
     * @return array|false Retorna dados do usuário ou false se inválido
     */
    public function validarToken($token) {
        $stmt = $this->conn->prepare("
            SELECT r.usuario_idusuario, u.email 
            FROM recuperacao_senha r
            JOIN usuario u ON r.usuario_idusuario = u.idusuario
            WHERE r.token = :token AND r.expira >= NOW()
        ");
        $stmt->execute(['token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false; // Retorna usuário ou false
    }

    /**
     * Atualiza a senha do usuário e invalida o token
     * @param int $idusuario ID do usuário
     * @param string $novaSenha Nova senha em texto plano
     * @return bool True se sucesso, false se falha
     */
    public function atualizarSenha($idusuario, $novaSenha) {
        try {
            $hash = password_hash($novaSenha, PASSWORD_DEFAULT); // Criptografa nova senha

            // Atualiza senha do usuário
            $stmt = $this->conn->prepare("UPDATE usuario SET senha = :senha WHERE idusuario = :idusuario");
            $stmt->execute(['senha' => $hash, 'idusuario' => $idusuario]);

            // Remove todos os tokens do usuário
            $stmt = $this->conn->prepare("DELETE FROM recuperacao_senha WHERE usuario_idusuario = :idusuario");
            $stmt->execute(['idusuario' => $idusuario]);

            return true;

        } catch (PDOException $e) {
            $_SESSION['erro'] = "Erro ao atualizar senha: " . $e->getMessage();
            return false;
        } catch (Throwable $e) {
            $_SESSION['erro'] = "Erro inesperado. Tente novamente mais tarde.";
            error_log($e->getMessage());
            return false;
        }
    }

    
}
?>
