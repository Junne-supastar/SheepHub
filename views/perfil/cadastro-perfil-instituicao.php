<?php
session_start();
if (!isset($_SESSION['idusuario'])) {
    header("Location: /SheepHub/public/index.php");
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
    <div>
        <div id="ovelha"></div>
    </div>

    <div class="cadastrar">
        <h2 class="destaqueTexto" id="cadastroTexto">Só mais um pouco!</h2>

        <!-- Envia para a rota de salvamento da primeira etapa -->
        <form action="/SheepHub/rotas/cadastro-perfil-instituicao-salvar.php" method="post">
            <input class="inserir" type="hidden" name="idusuario" value="<?= $_SESSION['idusuario'] ?>">

            <input class="inserir" type="text" name="cnpj" placeholder="CNPJ" required>

            <input class="inserir" type="text" name="cep" placeholder="CEP" required>

            <input class="inserir" type="text" name="telefone" placeholder="Telefone" required>

            <input class="inserir" type="url" name="site" placeholder="Site">

            <textarea class="inserir" name="descricao" placeholder="Descrição"></textarea>

            <button class="enviar" type="submit">Continuar</button>
        </form>
    </div>
</main>
</body>
</html>
