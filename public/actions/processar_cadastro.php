<?php
session_start();

// Inclui os controllers
require_once __DIR__ . '/../../controllers/UsuarioController.php';
require_once __DIR__ . '/../../controllers/UsuarioInstituicaoController.php';

// Pega o nível enviado pelo formulário
$nivel = $_POST['nivel'] ?? null;

// Se não tiver nível definido, volta para o cadastro com erro
if (!$nivel) {
    $_SESSION['errors'] = ['Nível do usuário não definido.'];
    header('Location: \Sheephub/views/auth/cadastro.php');
    exit;
}

try {
    if ($nivel == 2) {
        // Cadastro de instituição
        $controller = new UsuarioInstituicaoController();
        $resultado = $controller->salvar([
            'nivel' => $_POST['nivel'],
            'cnpj' => $_POST['cnpj'] ?? null,
            'email_instituicao' => $_POST['email_instituicao'] ?? null,
            'senha_instituicao' => $_POST['senha_instituicao'] ?? null,
            'telefone_instituicao' => $_POST['telefone_instituicao'] ?? null,
            'descricao' => $_POST['descricao'] ?? null,
            'nome_instituicao' => $_POST['nome_instituicao'] ?? null
        ]);

        if (!empty($resultado['errors'])) {
            $_SESSION['errors'] = $resultado['errors'];
            header('Location: \Sheephub/views/auth/cadastro.php');
            exit;
        }

        // Redireciona para página de confirmação
        header('Location: \Sheephub/views/auth/confirmar-cadastro.php');
        exit;

    } elseif ($nivel == 4) {
    // Cadastro de usuário membro
    $controller = new UsuarioController();
    $resultado = $controller->salvar([
        'nivel' => $_POST['nivel'],
        'username' => $_POST['username'] ?? null,
        'nome' => $_POST['nome'] ?? null,
        'email' => $_POST['email'] ?? null,
        'senha' => $_POST['senha'] ?? null,
        'data_nascimento' => $_POST['data_nascimento'] ?? null
    ]);

    if (!empty($resultado['errors'])) {
        $_SESSION['errors'] = $resultado['errors'];
        header('Location: \Sheephub/views/auth/cadastro.php');
        exit;
    }

    // Pega o id do novo usuário criado
    $newId = $resultado['idusuario'] ?? null; // seu salvar() deve retornar o id do usuário
    if (!$newId) {
        $_SESSION['errors'] = ['Erro interno: id do novo usuário não retornado.'];
        header('Location: \Sheephub/views/auth/cadastro.php');
        exit;
    }

    // salva id na sessão
    $_SESSION['idusuario'] = $newId;

    // Usuário normal precisa escolher instituição
    header('Location: \Sheephub/views/auth/escolher_instituicao.php');
    exit;
} elseif ($nivel == 5) {
        // Cadastro de visitante
        $controller = new UsuarioController();
        $resultado = $controller->salvar([
            'nivel' => $_POST['nivel'],
            'username' => $_POST['username'] ?? null,
            'nome' => $_POST['nome'] ?? null,
            'email' => $_POST['email'] ?? null,
            'senha' => $_POST['senha'] ?? null,
            'data_nascimento' => $_POST['data_nascimento'] ?? null
        ]);

        if (!empty($resultado['errors'])) {
            $_SESSION['errors'] = $resultado['errors'];
            header('Location: \Sheephub/views/auth/cadastro.php');
            exit;
        }

        // Visitante vai direto para confirmação
        header('Location: \Sheephub/views/auth/confirmar-cadastro.php');
        exit;

    } else {
        // Caso o nível seja inválido
        $_SESSION['errors'] = ['Nível de usuário inválido.'];
        header('Location: \Sheephub/views/auth/cadastro.php');
        exit;
    }

} catch (Exception $e) {
    $_SESSION['errors'] = ['Ocorreu um erro ao processar o cadastro.'];
    header('Location: \Sheephub/views/auth/cadastro.php');
    exit;
}
