<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/UsuarioInstituicao.php';

class AuthController {
    private $usuarioModel;
    private $instituicaoModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
        $this->instituicaoModel = new UsuarioInstituicao();

        // Cria pasta logs se não existir
        $logDir = __DIR__ . '/../helpers/logs';
        if (!file_exists($logDir)) {
            mkdir($logDir, 0777, true);
        }
    }

    public function login($email, $senha) {
        // Log simples
        file_put_contents(__DIR__.'/../helpers/logs/login.txt', "Tentativa: $email\n", FILE_APPEND);

        // Tenta autenticar usuário normal
        $usuario = $this->usuarioModel->autenticar($email, $senha);

        // Se não encontrou, tenta autenticar instituição
        if (!$usuario) {
            $usuario = $this->instituicaoModel->autenticar($email, $senha); // você precisa criar este método
        }

        if ($usuario) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['idusuario'] ?? $usuario['idusuario_instituicao'];
            $_SESSION['nivel'] = $usuario['nivel'];
            $_SESSION['username'] = $usuario['username'] ?? $usuario['nome_instituicao'];
            
            // Redireciona conforme nível
            if ($usuario['nivel'] == 2) {
                header('Location: ../views/dashboard_financas.php'); // Instituição
            } else {
                header('Location: ../views/auth/confirmar-cadastro.php'); // Membro/Visitante
            }
            exit;
        } else {
            session_start();
            $_SESSION['erro'] = "Email ou senha inválidos";
            header('Location: ../views/auth/login.php');
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../views/auth/login.php');
        exit;
    }
}
