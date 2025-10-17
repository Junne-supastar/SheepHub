<?php
session_start();
require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Perfil.php';
require_once __DIR__ . '/../controllers/PerfilController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = Conexao::getConexao();
    $model = new PerfilModel($pdo);
    $controller = new PerfilController($model);

    // salva esses primeiros campos (faça um método específico ou aproveite o existente)
    $controller->salvarDadosBasicos($_POST);

    // redireciona para a segunda etapa
    header('Location: /SheepHub/views/PerfilEstilo.php');

    exit;
}
header('Location: /SheepHub/views/cadastro-perfil.php');
exit;
