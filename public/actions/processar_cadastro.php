<?php
session_start();
require_once __DIR__ . '/../../controllers/UsuarioController.php';
require_once __DIR__ . '/../../controllers/UsuarioInstituicaoController.php';

$nivel = $_POST['nivel'] ?? null;

if (!$nivel) {
    $_SESSION['errors'] = ['Nível do usuário não definido.'];
    header('Location: ../../views/cadastro.php');
    exit;
}

try {
    if ($nivel == 2) {
        // Cadastro de instituição
        $controller = new UsuarioInstituicaoController();
        $controller->salvar(
            $_POST['nivel'],
            $_POST['cnpj'] ?? null,
            $_POST['email_instituicao'] ?? null,
            $_POST['senha_instituicao'] ?? null,
            $_POST['telefone_instituicao'] ?? null,
            $_POST['descricao'] ?? null,
            $_POST['username_instituicao'] ?? null
        );

        // Redireciona para página "bem-vindo"
        header('Location: ../../views/bem-vindo.php');
        exit;
    } else {
        // Cadastro de usuário normal
        $controller = new UsuarioController();
        $resultado = $controller->salvar([
            'nivel' => $_POST['nivel'],
            'username' => $_POST['username'] ?? null,
            'email' => $_POST['email'] ?? null,
            'senha' => $_POST['senha'] ?? null,
            'data_nascimento' => $_POST['nascimento'] ?? null
        ]);

        if (!empty($resultado['errors'])) {
            $_SESSION['errors'] = $resultado['errors'];
            header('Location: ../../views/cadastro.php');
            exit;
        }

        // Usuário normal precisa escolher instituição antes
        header('Location: ../../views/escolher_instituicao.php');
        exit;
    }
} catch (Exception $e) {
    $_SESSION['errors'] = ['Ocorreu um erro ao processar o cadastro.'];
    header('Location: ../../views/cadastro.php');
    exit;
}
