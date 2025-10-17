<?php
session_start();
require_once __DIR__ . '/../../controllers/CaixinhaController.php';

$controller = new CaixinhaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Envia os dados do POST para o controller
    $controller->sacar($_POST);
} 

// Redireciona sempre para a página de caixinhas
header("Location: /SheepHub/views/dashboard/caixinha/caixinha.php");
exit;
