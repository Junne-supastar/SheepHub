<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }
       
    public function login($email, $senha) {
        file_put_contents(__DIR__.'/../logs/login.txt', "Entrou com: $email\n", FILE_APPEND);
    
        $usuario = $this->usuarioModel->autenticar($email, $senha);
    
        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nivel_acesso'] = $usuario['nivel'];
            file_put_contents(__DIR__.'/../logs/login.txt', "Login OK para $email\n", FILE_APPEND);
            header('Location: ../views/dashboard/index.php');
            exit;
        } else {
            $_SESSION['erro'] = 'E-mail ou senha inválidos';
            file_put_contents(__DIR__.'/../logs/login.txt', "Login FALHOU para $email\n", FILE_APPEND);
            header('Location: ../views/auth/login.php');
            exit;
        }
    }
    
    public function registrar($email, $senha) {
        
        $resultado = $this->usuarioModel->registrar($email, $senha);

        if ($resultado) {
            $_SESSION['mensagem'] = 'Usuário registrado com sucesso';
            header('Location: ../views/auth/login.php');
            exit;
        } else {
            $_SESSION['erro'] = 'Este e-mail já está em uso. Por favor, escolha outro.';
            header('Location: ../views/auth/register.php');
            exit;
        }
    }
    
    public static function verificarLogin() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ../views/auth/login.php');
        }
    }

    public static function logout() {
        session_destroy();
        header('Location: ../views/auth/login.php');
    }
}


