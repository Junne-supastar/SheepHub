<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Escolha de Cadastro</title>
    <link rel="stylesheet" href="style1.css">
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
                <h3>Desejo me cadastrar como:</h3>
            </div>
            <div id="inf">
                <form action="cadastro.php" method="get">
                    <button class="tipo" type="submit" name="tipo" value="membro">Membro</button>
                    <button class="tipo" type="submit" name="tipo" value="visitante">Visitante</button>
                    <button class="tipo" type="submit" name="tipo" value="lider">Igreja</button>
                </form>
                <p>Já possui uma conta? <a id="login" href="">Faça login</a></p>
            </div>

        </div>
    </main>
</body>
</html>
