<?php
session_start();

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../controllers/AuthController.php';

// Cria instância do model e do controller
$model = new Usuario();
$auth = new AuthController($model);

// Chama o logout
$auth->logout();
