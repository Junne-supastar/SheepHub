<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrar - SisEteot</title>
  <link rel="stylesheet" href="assets/stylesRegister.css" />
</head>
<body>
  <div class="register-wrapper">
    <div class="diagonal-background"></div> <!-- diagonal invertida -->

    <div class="left-panel">
      <form id="registerForm" method="POST" action="../../public/index.php?acao=registrar" autocomplete="off">
        <h3>Criar Conta</h3>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Digite seu email" required />

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required />

        <button type="submit">REGISTRAR</button>
        <p>Já tem uma conta? <a href="login.php">Entrar</a></p>
      </form>

    </div>

    <div class="right-panel branding">
      <img src="assets/img/logo_siseteot.png" alt="SisEteot Logo" class="logo" />
      <h4>MENOS PAPEL. MAIS TEMPO.</h4>
      <p>Praticidade e agilidade<br> para a Comunidade Escolar.</p>
    </div>
    <!-- MSG TOAST -->
    <?php if (!empty($_SESSION['erro'])): ?>
      <div id="toast" class="toast" data-msg="<?= addslashes($_SESSION['erro']) ?>" data-type="exception"></div>
    <?php unset($_SESSION['erro']); ?>
    <?php else: ?>
      <div id="toast" class="toast"></div>
    <?php endif; ?>
    <!-- FIM MSG TOAST -->
  </div>
  <script src="../dashboard/inc/js/toast.js"></script>
</body>
</html>
