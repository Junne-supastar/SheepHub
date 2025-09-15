<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Descobre a ação enviada pelo form
$acao = $_POST['acao'] ?? $_GET['acao'] ?? null;

// Se for cadastro de usuário ou instituição
if ($acao === 'salvar_usuario' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $nivel = $_POST['nivel']; // 1 = membro, 2 = instituição, 3 = visitante

    // Escolhe o controller correto
    if ($nivel == 2) {
        require_once __DIR__ . '/../controllers/UsuarioInstituicaoController.php';
        $controller = new UsuarioInstituicaoController();
    } else {
        require_once __DIR__ . '/../controllers/UsuarioController.php';
        $controller = new UsuarioController();
    }

    // Salva os dados do form
    $resultado = $controller->salvar($_POST);

    if (!empty($resultado['success']) && $resultado['success']) {
        // Cadastro feito, redireciona para cadastro de localidade
        header('Location: ../views/auth/cadastro_localidade.php?user_id=' . $resultado['id'] . '&nivel=' . $nivel);
        exit;
    } else {
        // Se houver erro, armazena na sessão e volta para o form
        $_SESSION['errors'] = $resultado['errors'] ?? ['Erro desconhecido'];
        header('Location: ../views/auth/cadastro.php?nivel=' . $nivel);
        exit;
    }
}

// Se não for ação de cadastro, mostra o form
require_once __DIR__ . '/../views/auth/cadastro.php';
exit;
