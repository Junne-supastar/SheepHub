<?php
require_once __DIR__ . '/../controllers/AuthController.php';

if (session_status() === PHP_SESSION_NONE) session_start();

$acao = $_POST['acao'] ?? $_GET['acao'] ?? null;

if ($acao === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Chamando login...\n"; // temporário para testar
    (new AuthController())->login($_POST['email'], $_POST['senha']);
    
} elseif ($acao === 'registrar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    (new AuthController())->registrar($_POST['email'], $_POST['senha']);
} else {
        header('Location: ../views/auth/login.php');
}



