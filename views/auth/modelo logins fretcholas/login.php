<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="Pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thria Docs - Login</title>
  <link rel="stylesheet" href="assets/stylesLogin.css" />
</head>
<body>
    <div class="login-wrapper">
      <div class="diagonal-background"></div>  <!-- fundo azul diagonal com clip-path -->
      
      <div class="left-panel">
        <img src="assets/img/logo_siseteot.png" alt="NSOC Logo" class="logo" />
        <h4>MENOS PAPEL. MAIS TEMPO.</h4>
        <p>Praticidade e agilidade<br> para a Comunidade Escolar.</p>
      </div>

      <div class="right-panel">
            
        <form id="loginForm" action="../../public/index.php" method="POST" autocomplete="off">
          <input type="hidden" name="acao" value="login"> 
          <div><h3>Entrar</h3></div>
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="Digite o seu email" value="freitas@gmail.com" required />
        
          <label for="senha">Senha</label>
          <input type="password" name="senha" id="senha" placeholder="Digite a sua senha" value="123" required />
        
          <div class="options">
            <label><input type="checkbox" /> Lembrar</label>
            <a href="#">Esqueceu a senha?</a>
          </div>
        
          <button type="submit">LOGIN</button>
          <p>Não tem uma conta?<a href="register.php" class="btn btn-link"> Registre-se </a></p>
        </form>
        <!-- MSG TOAST -->
        <?php if (!empty($_SESSION['erro'])): ?>
          <div id="toast" class="toast" data-msg="<?= addslashes($_SESSION['erro']) ?>"></div>
          <?php unset($_SESSION['erro']); ?>
        <?php else: ?>
          <div id="toast" class="toast"></div>
        <?php endif; ?>
        <!-- FIM MSG TOAST -->
      </div>
    </div>
      
    <script src="assets/scriptLogin.js" defer></script> 
    <!-- Use defer para garantir que ele carregue depois do HTML -->
  </body>
</html>



