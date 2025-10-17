    <?php
    session_start();
    if (!isset($_SESSION['idusuario'])) {
        header("Location: /SheepHub/public/index.php");
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Perfil</title>
    <link rel="stylesheet" href="/SheepHub/views/assets/css/perfilEstilo.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    </head>
    <body>
    <section class="container">
        <form class="card" action="/SheepHub/rotas/perfil-salvar.php" method="post" enctype="multipart/form-data">

            <h2>Estilize seu perfil!</h2>

            <!-- ID do usuário logado -->
            <input type="hidden" name="idusuario" value="<?= $_SESSION['idusuario'] ?>">

            <div class="capa-container">
                <div class="capa">
                <input type="file" name="foto_fundo" id="arquivo-banner">
                    <label for="arquivo-banner" class="upload"><i class='bx bx-upload'></i></label>
                </div>
                <div class="avatar">
                    <input type="file" name="foto_perfil" id="arquivo-avatar">
                    <label for="arquivo-avatar" class="icone-usuario"><i class='bx bxs-user'></i></label>
                </div>
            </div>

            <div class="input-container">
                <input type="text" name="biografia" maxlength="150" placeholder="Sua biografia (150 caracteres)">
                <input type="url" name="redes_sociais" placeholder="Adicione um link">
            </div>

            <button type="submit" class="btn-finalizar">Finalizar</button>
            <a href="/SheepHub/views/feed2.php" class="link-estilizar">Estilizar depois</a>
        </form>
    </section>
    <script src="/SheepHub/views/assets/js/script-perfil.js"></script>
    </body>
    </html>
