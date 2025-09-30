<?php
session_start();
require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Perfilinstituicao.php';
require_once __DIR__ . '/../controllers/PerfilInstituicaoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = Conexao::getConexao();
    $model = new PerfilInstituicao($pdo);
    $controller = new PerfilInstituicaoController($model);

    // salva esses primeiros campos (faça um método específico ou aproveite o existente)
    $controller->salvarDadosBasicos($_POST);

    // redireciona para a segunda etapa
    header('Location: /SheepHub/views/perfil-instituicao-estilo.php');

    exit;
}
header('Location: /SheepHub/views/cadastro-perfil-instituicao.php');
exit;
