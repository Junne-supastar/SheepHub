<?php
session_start();
require_once __DIR__ . '/../../models/Permissao.php';

// Pega dados do POST
$idusuario = $_POST['idusuario'] ?? null;
$idusuario_instituicao = $_POST['idusuario_instituicao'] ?? null;

if (!$idusuario || !$idusuario_instituicao) {
    $_SESSION['errors'] = ['Usuário ou instituição não identificados.'];
    header('Location: \Sheephub/views/auth/escolher_instituicao.php');
    exit;
}

// Usa o model
$permissaoModel = new Permissao();
$result = $permissaoModel->solicitarFiliação($idusuario, $idusuario_instituicao);

if ($result['success']) {
    $_SESSION['success'] = 'Solicitação enviada! A instituição precisa aprovar sua filiação.';
    header('Location:  \Sheephub/views/auth/confirmar-cadastro.php');
    exit;
} else {
    $_SESSION['errors'] = $result['errors'];
    header('Location: \Sheephub/views/auth/escolher_instituicao.php');
    exit;
}
