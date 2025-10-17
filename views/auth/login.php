<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
  <main class="conteudo-principal">
    <section class="painel-esquerdo">
      
    </section>

    <section class="painel-direito">
      <header class="cabecalho-login">
        <h1>Olá!<br><span class="marca">Sheephuber</span></h1>
        <h2>Entre com sua conta</h2>
      </header>

<<<<<<< HEAD
      <form class="formulario-login" action="../../public/actions/index.php" method="POST">
=======
<form class="formulario-login" action="/SheepHub/public/index.php" method="POST">

>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
        <input type="hidden" name="acao" value="login">

        <fieldset class="grupo-campos">
          <input type="email" name="email" placeholder="E-mail" required>
          <input type="password" name="senha" placeholder="Senha" required>
        </fieldset>

<<<<<<< HEAD
        <div class="opcoes-login">
          <label><input type="checkbox"> Lembrar senha</label>
          <a href="../recuperacao_senha/solicitar.php">Esqueceu a senha?</a>
        </div>

        <button type="submit" class="botao-login">Login</button>
=======
<div class="opcoes-login">
  <label><input type="checkbox"> Lembrar senha</label>
  <a href="../recuperacao_senha/solicitar.php">Esqueceu a senha?</a>
</div>

<?php if (!empty($_SESSION['erro_login'])): ?>
  <p style="color: #b30000; font-weight: 500; font-size: 14px; margin: 8px 0;">
    <?= $_SESSION['erro_login']; ?>
  </p>
  <?php unset($_SESSION['erro_login']); ?>
<?php endif; ?>

<button type="submit" class="botao-login">Login</button>



>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46

        <p class="texto-cadastro">
          Não possui conta? <a href="escolha.php">Cadastre-se</a>
        </p>
      </form>

<<<<<<< HEAD
      <?php if (!empty($_SESSION['erro'])): ?>
  <div id="toast" class="toast" data-msg="<?= addslashes($_SESSION['erro']) ?>"></div>
  <?php unset($_SESSION['erro']); ?>
<?php else: ?>
  <div id="toast" class="toast"></div>
<?php endif; ?>
=======


>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46


      <div class="divisor">Ou entre com</div>

      <nav class="login-social">
        <a href="#"><img src="../assets/img/logoapple.svg" alt="Entrar com Apple"></a>
        <a href="#"><img src="../assets/img/googleicon.svg" alt="Entrar com Google"></a>
        <a href="#"><img src="../assets/img/iconfacebook.png" alt="Entrar com Facebook"></a>

      </nav>
    </section>
  </main>
</body>
</html>

    
</body>
</html>