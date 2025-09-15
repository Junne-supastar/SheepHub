<?php
$tipo = $_GET['tipo'] ?? 'membro';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <main>
        <div>
            <div id="ovelha"></div>
        </div>

        <div class="cadastrar">
            <h2 class="destaqueTexto" id="cadastroTexto">Cadastre-se agora</h2>

            <form action="salvar_usuario.php" method="post">
                <input class="inserir" type="hidden" name="tipo" value="<?php echo $tipo; ?>">

                <input class="inserir" type="text" name="username" placeholder="Usuário" required>

                <input class="inserir" type="text" name="nome" placeholder="Primeiro nome" required>

                <input class="inserir" type="date" name="nascimento" max="<?php echo date('Y-m-d'); ?>" placeholder="Data de nascimento" required>

                <input class="inserir" type="email" name="email" placeholder="E-mail" required>

                <input class="inserir" type="password" name="senha" placeholder="Sua senha" required>

                <button class="enviar" type="submit"><?php echo ($tipo === 'lider') ? 'Continuar' : 'Finalizar'; ?></button>
            </form>

        </div>
</main>
</body>
</html>

