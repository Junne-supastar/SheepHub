<?php
<<<<<<< HEAD
require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../models/usuario.php';
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../models/PerfilInstituicao.php';
require_once __DIR__ . '/../../controllers/PerfilInstituicaoController.php';
=======
require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/usuario.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../models/PerfilInstituicao.php';
require_once __DIR__ . '/../controllers/PerfilInstituicaoController.php';
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46

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
        } else if ($usuario["nivel"] == 3) { // Líder/instituição
            $pdo = Conexao::getConexao();
            $modelPerfilInstituicao = new PerfilInstituicao($pdo);
            $idusuarioDebug = $usuario["idusuario"];
            $perfilExistente = $modelPerfilInstituicao->getPerfilInstituicao($idusuarioDebug);

            // Debug: exibe idusuario e resultado da busca
            error_log("DEBUG: idusuario login = " . $idusuarioDebug);
            error_log("DEBUG: perfilExistente = " . print_r($perfilExistente, true));

            if (!$perfilExistente) {
                error_log("DEBUG: Redirecionando para cadastro de perfil institucional");
                header("Location: ../rotas/cadastro-perfil-instituicao-salvar.php");
            } else {
                error_log("DEBUG: Redirecionando para perfil institucional");
                // Redireciona direto para o perfil institucional
                header("Location: /SheepHub/views/perfil-lider.php?id=" . $idusuarioDebug);
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
