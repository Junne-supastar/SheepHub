<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperação de Senha</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
  <?php if (!empty($_SESSION['erro'])): ?>
    <p style="color:red;font-weight:bold;"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
  <?php endif; ?>

  <?php if (!empty($_SESSION['sucesso'])): ?>
    <p style="color:green;font-weight:bold;"><?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?></p>
  <?php endif; ?>

  <form action="/SheepHub/public/recuperacao.php" method="POST" style="max-width:400px;margin:40px auto;display:flex;flex-direction:column;gap:15px;">
    <input type="email" name="email" placeholder="Digite seu e-mail" required style="padding:10px;border:1px solid #ccc;border-radius:5px;">
    <button type="submit" style="padding:12px;background:#007BFF;color:#fff;border:none;border-radius:5px;cursor:pointer;">Enviar Link</button>
  </form>
</body>
</html>
