<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Inclui o controller
require_once __DIR__ . '/../controllers/RecuperacaoSenhaController.php';

// Instancia e chama o método de redefinir
$controller = new RecuperacaoSenhaController();
$controller->redefinir();
