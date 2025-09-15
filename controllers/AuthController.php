<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/UsuarioInstituicao.php';

class AuthController {

    public function login($email, $senha) {
        // Primeiro tenta encontrar o usuário normal
        $userModel = new Usuario();
        $usuario = $userModel->autenticar($email, $senha);

        if (!$usuario) {
            // Tenta encontrar uma instituição
            $instModel = new UsuarioInstituicao();
            $usuario = $instModel->autenticar($email, $senha);
        }

        if ($usuario) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['idusuario'] ?? $usuario['idusuario_instituicao'];
            $_SESSION['nivel'] = $usuario['nivel'];
            $_SESSION['username'] = $usuario['username'] ?? $usuario['username_instituicao'];
            // Redireciona conforme nível
            if ($usuario['nivel'] == 2) {
                header('Location: ../views/dashboard/index.php'); // Instituição
            } else {
                header('Location: ../views/feed/index.php'); // Membro/Visitante
            }
            exit;
        } else {
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
