<?php
<<<<<<< HEAD
require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/usuario.php';
=======

// index.php (ponto de entrada para login e registro)

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Usuario.php';
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../models/PerfilInstituicao.php';
require_once __DIR__ . '/../controllers/PerfilInstituicaoController.php';

<<<<<<< HEAD
if (session_status() === PHP_SESSION_NONE) session_start();

$acao = $_POST['acao'] ?? $_GET['acao'] ?? null;

$modelUsuario = new Usuario(); // model que acessa apenas a tabela usuario
$authController = new AuthController($modelUsuario); // passar o model para o controller

if ($acao === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Chamando login...\n"; // só para teste
    $usuario = $authController->login($_POST['email'], $_POST['senha']);

    if ($usuario) {
        $_SESSION['idusuario'] = $usuario['idusuario'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['nivel'] = $usuario['nivel'];

        // redirecionar dependendo do nível
        if ($usuario['nivel'] == 4) { // membro
            header("Location: ../rotas/perfil-membro.php");
        } else if ($usuario["nivel"] == 3) { // Líder
            $pdo = Conexao::getConexao();
            $modelPerfilInstituicao = new PerfilInstituicao($pdo);
            $perfilExistente = $modelPerfilInstituicao->getPerfilInstituicao($usuario["idusuario"]);

            if (!$perfilExistente) {
                header("Location: ../rotas/cadastro-perfil-instituicao-salvar.php");
            } else {
                header("Location: ../rotas/dashboard.php");
            }
        } else {
            header("Location: ../rotas/dashboard.php");
        }
        exit;
    } else {
        echo "Login ou senha incorretos!";
    }

} elseif ($acao === 'registrar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->registrar($_POST['email'], $_POST['senha']);
} else {
    header('Location: ../views/auth/login.php');
}
=======
// Inicia sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) session_start();

// Captura a ação vinda do formulário
$acao = $_POST['acao'] ?? $_GET['acao'] ?? null;

// Cria o model e controller
$modelUsuario = new Usuario();
$authController = new AuthController($modelUsuario);

switch ($acao) {

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Chama o login (AuthController já cria a sessão e redireciona)
            $authController->login($_POST['email'], $_POST['senha']);
        }
        break;

    case 'registrar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Passa todo o POST para registrar
            $authController->registrar($_POST);
        }
        break;

    default:
        // Nenhuma ação: redireciona para a página de login
        header('Location: ../views/auth/login.php');
        exit;
}

>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
