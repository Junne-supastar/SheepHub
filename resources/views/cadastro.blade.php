<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro Usuário</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/login.css'" />
</head>
<body>
  <main class="conteudo-principal cadusuario">
    <section class="painel-esquerdo">
      <!-- Pode colocar algo aqui, se quiser -->
    </section>

    <section class="painel-direito">
      <header class="cabecalho-login">
        <h1>Olá!<br /><span class="marca">Sheephuber</span></h1>
        <h2>Cadastre-se agora</h2>
      </header>

      <form class="formulario-login" method="POST" action="{{ route('register') }}">
        @csrf
        <fieldset class="grupo-campos">
          <input type="text" name="name" placeholder="Nome" required value="{{ old('name') }}" />
          <input type="email" name="email" placeholder="E-mail" required value="{{ old('email') }}" />
          <input type="password" name="password" placeholder="Senha" required />
          <input type="password" name="password_confirmation" placeholder="Confirmar senha" required />
        </fieldset>

        <button type="submit" class="botao-login">Cadastrar</button>

        <p class="texto-cadastro">
          Já possui uma conta? <a href="{{ route('login') }}">Faça Login</a>
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
