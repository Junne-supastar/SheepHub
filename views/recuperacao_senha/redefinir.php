<<<<<<< HEAD
ta assim a view

<?php
// Mantém a sessão ativa
session_start();

// Exibe mensagens de erro ou sucesso
if (!empty($_SESSION['erro'])) {
    echo "<p style='color:red; font-weight:bold'>{$_SESSION['erro']}</p>";
    unset($_SESSION['erro']);
}
if (!empty($_SESSION['sucesso'])) {
    echo "<p style='color:green; font-weight:bold'>{$_SESSION['sucesso']}</p>";
    unset($_SESSION['sucesso']);
}

// Captura o token da URL de forma segura
$token = htmlspecialchars($_GET['token'] ?? '');
?>

<div style="max-width: 400px; margin: 50px auto; padding: 20px; background: #f9f9f9; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);">
    <h2 style="text-align:center; color:#333;">Redefinir Senha</h2>
    <form method="POST" action="?token=<?= $token ?>" style="display:flex; flex-direction:column; gap:15px;">
        <label for="senha">Nova Senha:</label>
        <input type="password" name="senha" id="senha" required placeholder="Digite a nova senha" style="padding:10px; border-radius:5px; border:1px solid #ccc;">

        <label for="conf_senha">Confirme a Senha:</label>
        <input type="password" name="conf_senha" id="conf_senha" required placeholder="Confirme a senha" style="padding:10px; border-radius:5px; border:1px solid #ccc;">

        <button type="submit" style="padding:12px; background-color:#007BFF; color:#fff; border:none; border-radius:5px; font-weight:bold; cursor:pointer;">Atualizar Senha</button>
    </form>
</div>
=======
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
</head>
<body>
  <main class="conteudo-principal">
    <section class="painel-esquerdo">
      <!-- fundo ou imagem -->
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
          <a href="/SheepHub/public/index.php" style="color:#007BFF; text-decoration:none;">Voltar para login</a>
        </p>
      <?php endif; ?>
    </section>
  </main>
</body>
</html>
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
