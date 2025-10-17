<?php
// rotas/router_metas.php

require_once __DIR__ . '/../controllers/MetaController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new MetaController();

$acao = $_GET['action'] ?? null;
$id = $_GET['id'] ?? $_GET['id_meta'] ?? null;

switch ($acao) {
    case 'excluir':
        if ($id) {
            $controller->excluirMeta($id);
        }
        header("Location: ../views/dashboard/criarMeta.php");
        exit;

    case 'editar':
    case 'ver':
        header("Location: ../views/dashboard/cadastroMeta.php?action={$acao}&id={$id}");
        exit;

    case 'concluir':
        if ($id) {
            $controller->concluirMeta($id);
        }
        header("Location: ../views/dashboard/criarMeta.php");
        exit;

    case 'cadastrar':
        header("Location: ../views/dashboard/cadastroMeta.php?action=cadastrar");
        exit;

    default:
        header("Location: ../views/dashboard/criarMeta.php");
        exit;
}
