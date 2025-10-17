<?php

// index.php (ponto de entrada para login e registro)

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../models/PerfilInstituicao.php';
require_once __DIR__ . '/../controllers/PerfilInstituicaoController.php';

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

