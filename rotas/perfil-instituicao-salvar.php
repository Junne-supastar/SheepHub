<?php
session_start();

// Inclui arquivos necessários
require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/PerfilInstituicao.php';
require_once __DIR__ . '/../controllers/PerfilInstituicaoController.php';

// Cria a conexão PDO
$pdo = Conexao::getConexao();

// Instancia o model e o controller
$model = new PerfilInstituicao($pdo);
$perfilController = new PerfilInstituicaoController($model);

// Verifica se veio POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $perfilController->salvarPerfil($_POST, $_FILES);

    // Redireciona para o perfil do usuário logado
    $idusuario = $_SESSION['idusuario'];
    header("Location: ../views/perfil.php?id=$idusuario");
    exit;
}

// Se acessar direto sem POST, pode redirecionar para o feed ou perfil
header("Location: ../views/feed2.php");
exit;
