<?php
session_start();

// Redireciona se não estiver logado
if (!isset($_SESSION['idusuario'])) {
    header("Location: /SheepHub/public/index.php");
    exit;
}

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/Perfil.php';
require_once __DIR__ . '/../controllers/PerfilController.php';

// Pega a conexão PDO
$pdo = Conexao::getConexao();

// Cria o model e o controller
$model = new PerfilModel($pdo);
$perfilController = new PerfilController($model);

// Busca dados do usuário logado
$idusuario = $_SESSION['idusuario'];
$perfil = $perfilController->model->getPerfilMembro($idusuario);

// Se não existir, inicializa array vazio para evitar erros
if (!$perfil) {
    $perfil = [
        'biografia' => '',
        'funcao' => '',
        'cep' => '',
        'redes_sociais' => '',
        'foto_perfil' => '',
        'foto_fundo' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Perfil Membro</title>
    <link rel="stylesheet" href="/SheepHub/views/assets/css/form-perfil.css">
</head>
<body>
    <div class="container-form">
        <h2><?= $perfil ? "Editar Perfil" : "Criar Perfil" ?></h2>
        <form action="/SheepHub/rotas/perfil-salvar.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="idusuario" value="<?= $idusuario ?>">

            <label for="biografia">Biografia:</label>
            <textarea name="biografia" id="biografia" rows="4"><?= $perfil['biografia'] ?></textarea>

            <label for="funcao">Função:</label>
            <input type="text" name="funcao" id="funcao" value="<?= $perfil['funcao'] ?>">

            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" value="<?= $perfil['cep'] ?>">

            <label for="redes_sociais">Redes Sociais (links separados por vírgula):</label>
            <input type="text" name="redes_sociais" id="redes_sociais" value="<?= $perfil['redes_sociais'] ?>">

            <label for="foto_perfil">Foto de Perfil:</label>
            <input type="file" name="foto_perfil" id="foto_perfil">

            <label for="foto_fundo">Foto de Fundo:</label>
            <input type="file" name="foto_fundo" id="foto_fundo">

            <button type="submit"><?= $perfil ? "Atualizar Perfil" : "Criar Perfil" ?></button>
        </form>
    </div>
</body>
</html>
