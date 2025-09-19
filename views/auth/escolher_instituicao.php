<?php
session_start();
require __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../models/usuarioinstituicao.php';
require_once __DIR__ . '/../models/usuario.php';

$idusuario = $get['idusuario'] ?? $_post['idusuario'] ?? null;


if(!$idusuario) {
   die("Usuário não identificado."); 
}

$usuarioModel = new Usuario();
$usuario = $usuarioModel->buscarPorId($idusuario);

if (!$usuario) {
    die("Usuário não encontrado.");
}

$instModel = new UsuarioInstituicao();
$instituicoes = $instModel->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Escolha de Instituição</title>
    <link rel="stylesheet" href="assets/css/style1.css">
</head>
<body>
    <main>
        <div>
            <div id="ovelha"></div>
        </div>

        <div class="cadastrar">
            <div id="sup">
                <h2>Olá,</h2>
                <h2 class="destaqueTexto">Sheephuber!</h2>
                <h3>Insira sua instituição</h3>
            </div>
            <form method="POST" action="/../../public/action/processar_escolha.php">
            <input type="hidden" name="idusuario" value="<?= htmlspecialchars($idusuario) ?>">
                 
            <?php if ($nivel == 2): ?>
            
            <button type="submit" class="enviar">Enviar</button>
        </form>
    </div>
</main>
</body>
</html>
