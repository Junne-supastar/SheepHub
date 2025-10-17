<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function login($email, $senha) {
        // Busca o usuário pelo email
        $usuario = $this->model->autenticar($email, $senha);

     if ($usuario) {
    $_SESSION['idusuario'] = $usuario['idusuario'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['nivel'] = $usuario['nivel'];

    // Redireciona conforme o nível
    switch($usuario['nivel']) {
        case 1: // Administrador
            header("Location: /SheepHub/views/admin/dashboard.php");
            break;
        case 2: // Líder
        case 3: // Líder de comunidade
<<<<<<< HEAD
            header("Location: /SheepHub/views/perfil-lider.php");
=======
            header("Location: /SheepHub/views/dashboard/dashboard_financas.php");
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
            break;
        case 4: // Membro
            header("Location: /SheepHub/views/perfil-membro.php");
            break;
        case 5: // Visitante
            header("Location: /SheepHub/views/perfil-visitante.php");
            break;
        default:
            header("Location: /SheepHub/public/index.php");
    }
    exit;
} else {
    $_SESSION['erro_login'] = "Email ou senha incorretos!";
    header("Location: /SheepHub/public/index.php");
    exit;
}
    }

    public function logout() {
        session_destroy();
        header("Location: /SheepHub/public/index.php");
        exit;
    }

        public function registrar($dados) {
        $resultado = $this->model->salvar($dados);
        if ($resultado['success']) {
            echo "Usuário registrado com sucesso!";
        } else {
            echo implode("<br>", $resultado['errors']);
        }
    }
}
