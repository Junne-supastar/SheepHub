<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php
// Verifica se a variável $tokenExpirado foi definida pelo controller
$tokenExpirado = $tokenExpirado ?? false;

// Se o token expirou, ignora qualquer mensagem de sucesso
if ($tokenExpirado) {
    unset($_SESSION['sucesso']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redefinir Senha</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/SheepHub/views/assets/css/login.css">
  <style>
    .painel-esquerdo {
    width: 450px;
    height: 100%;
    overflow: hidden; 
    position: relative;
  }

  .painel-esquerdo img {
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
  }
  </style>
</head>
<body>
  <main class="conteudo-principal">
    <section class="painel-esquerdo">
      <!-- fundo ou imagem -->
      <img src="../assets/img/bg.jpg" alt="">
    </section>

    <section class="painel-direito">
      <header class="cabecalho-login">
        <?php if ($tokenExpirado): ?>
          <h1 style="color:#b30000;">Token Expirado</h1>
          <h2>O link de redefinição expirou.</h2>
        <?php else: ?>
          <h1>Redefinir Senha<br><span class="marca">Sheephuber</span></h1>
          <h2>Digite sua nova senha</h2>
        <?php endif; ?>
      </header>

      <!-- Mensagens -->
      <?php if (!$tokenExpirado && !empty($_SESSION['erro'])): ?>
        <p style="color: #b30000; font-weight: 500; font-size: 14px; margin: 8px 0;">
          <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </p>
      <?php endif; ?>

      <?php if (!$tokenExpirado && !empty($_SESSION['sucesso'])): ?>
        <p style="color: green; font-weight: 500; font-size: 14px; margin: 8px 0;">
          <?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
        </p>
      <?php endif; ?>

      <?php if ($tokenExpirado): ?>
        <p style="text-align:center; margin-top:15px; font-size:14px;">
          <a href="/SheepHub/public/recuperacao.php" style="color:#007BFF; text-decoration:none;">Solicitar novo link</a>
        </p>
      <?php else: ?>
        <form action="?token=<?= htmlspecialchars($_GET['token'] ?? '') ?>" method="POST" class="formulario-login">
          <fieldset class="grupo-campos">
            <input type="password" name="senha" placeholder="Nova senha" required>
          </fieldset>
          <fieldset class="grupo-campos">
            <input type="password" name="conf_senha" placeholder="Confirme a senha" required>
          </fieldset>

          <button type="submit" class="botao-login">Atualizar Senha</button>
        </form>

        <p style="text-align:center; margin-top:15px; font-size:14px;">
          <a href="../public/index.php" style="color:#007BFF; text-decoration:none;">Voltar para login</a>
        </p>
      <?php endif; ?>
    </section>
  </main>
</body>
</html>

>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
