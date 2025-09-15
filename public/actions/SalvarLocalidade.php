<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../../controllers/LocalidadeController.php';
require_once __DIR__ . '/../../controllers/UsuarioController.php';
require_once __DIR__ . '/../../controllers/UsuarioInstituicaoController.php';

// Pega dados do formulário
$dados_localidade = $_POST ?? [];

// Pega dados temporários do usuário
$usuario_temp = $_SESSION['usuario_temp'];
$nivel = $_SESSION['nivel_temp'];

if (!$usuario_temp || !$nivel) {
    $_SESSION['errors'] = ['Sessão expirada. Refaça o cadastro.'];
    header('Location: ../../views/auth/cadastro.php');
    exit;
}

// Salva a localidade
$localidadeCtrl = new LocalidadeController();
$resLocalidade = $localidadeCtrl->salvar($dados_localidade);

if (!$resLocalidade['success']) {
    $_SESSION['errors'] = $resLocalidade['errors'] ?? ['Erro ao salvar localidade'];
    header('Location: ../../views/auth/cadastro_localidade.php');
    exit;
}

// Adiciona o CEP nos dados do usuário
$usuario_temp['cep'] = $resLocalidade['id'];

// Aqui só salva o usuário **quando todos os dados do cadastro base já estão na sessão**
if (!empty($usuario_temp['username']) && !empty($usuario_temp['email']) && !empty($usuario_temp['senha'])) {
    $controller = ($nivel == 2)
        ? new UsuarioInstituicaoController()
        : new UsuarioController();

    $resUsuario = $controller->salvar($usuario_temp);
}

// Cria o usuário
$controller = ($nivel == 2)
    ? new UsuarioInstituicaoController()
    : new UsuarioController();

$resUsuario = $controller->salvar($usuario_temp);

// Limpa sessão temporária
unset($_SESSION['usuario_temp'], $_SESSION['nivel_temp']);

if (!empty($resUsuario['success']) && $resUsuario['success']) {
    header('Location: ../../views/auth/teste.php'); // aqui você escolhe se vai pro feed ou outra tela
    exit;
} else {
    $_SESSION['errors'] = $resUsuario['errors'] ?? ['Erro ao salvar usuário'];
    header('Location: ../../views/auth/cadastro_localidade.php');
    exit;
}
