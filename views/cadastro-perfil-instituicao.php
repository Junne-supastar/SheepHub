<?php
session_start();
require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/PerfilInstituicao.php';
require_once __DIR__ . '/../controllers/PerfilInstituicaoController.php';

if (!isset($_SESSION['idusuario'])) {
    header("Location: /SheepHub/public/index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new PerfilInstituicaoController();
    $controller->salvarDadosBasicos($_POST); // salva CNPJ, CEP, telefone, site, descricao
    header('Location: /SheepHub/views/perfil-instituicao-estilo.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Instituição</title>
    <link rel="stylesheet" href="/SheepHub/views/assets/css/cadastro-perfil.css">
</head>
<body>
<main>
    <div class="cadastrar">
        <h2>Cadastro da Instituição</h2>
   <form action="/SheepHub/rotas/cadastro-perfil-instituicao-salvar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idusuario" value="<?= $_SESSION['idusuario'] ?>">
    <input type="text" name="cnpj" placeholder="CNPJ" required>
    <input type="text" name="cep" placeholder="CEP" required>
    <input type="text" name="telefone" placeholder="Telefone" required>
    <input type="url" name="site" placeholder="Site">
    <textarea name="descricao" placeholder="Descrição"></textarea>
    <button type="submit">Continuar</button>
</form>
    </div>
</main>
</body>
</html>
