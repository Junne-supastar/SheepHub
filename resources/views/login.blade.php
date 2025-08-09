<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/login.css" />
</head>
<body>
  <main class="conteudo-principal">
    <section class="painel-esquerdo">
      {{-- Pode colocar uma imagem ou algo aqui --}}
    </section>

    <section class="painel-direito">
      <header class="cabecalho-login">
        <h1>Olá!<br /><span class="marca">Sheephuber</span></h1>
        <h2>Entre com sua conta</h2>
      </header>

      <form method="POST" action="{{ route('login') }}" class="formulario-login">
        @csrf

        <fieldset class="grupo-campos">
          <input type="email" name="email" placeholder="E-mail" required autofocus />
          <input type="password" name="password" placeholder="Senha" required />
        </fieldset>

        <div class="opcoes-login">
          <label><input type="checkbox" name="remember" /> Lembrar senha</label>
          <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
        </div>

        <button type="submit" class="botao-login">Login</button>

        <p class="texto-cadastro">
          Não possui conta? <a href="{{ route('register') }}">Cadastre-se</a>
        </p>
      </form>

      <div class="divisor">Ou entre com</div>

      <nav class="login-social">
        <a href="#"><img src="{{ asset('img/logoapple.svg') }}" alt="Entrar com Apple" /></a>
        <a href="#"><img src="{{ asset('img/googleicon.svg') }}" alt="Entrar com Google" /></a>
        <a href="#"><img src="{{ asset('img/iconfacebook.png') }}" alt="Entrar com Facebook" /></a>
      </nav>
    </section>
  </main>
</body>
</html>
