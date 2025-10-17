<?php
<<<<<<< HEAD
require_once __DIR__ . '/../controllers/AuthController.php';
AuthController::logout();
?>
=======
session_start();

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../controllers/AuthController.php';

// Cria instância do model e do controller
$model = new Usuario();
$auth = new AuthController($model);

// Chama o logout
$auth->logout();
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
