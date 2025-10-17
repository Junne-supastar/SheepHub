<?php
require_once __DIR__ . '/../controllers/RecuperacaoSenhaController.php';
session_start();

$controller = new RecuperacaoSenhaController();
$controller->solicitar();
