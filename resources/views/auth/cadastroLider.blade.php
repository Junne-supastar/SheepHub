<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro Líder Religioso</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/login.css'" />
</head>
<body>
  <main class="conteudo-principal cadlider">
    <section class="painel-esquerdo">
      <!-- Conteúdo esquerdo, se houver -->
    </section>

    <section class="painel-direito">
      <header class="cabecalho-login">
        <h1>Olá!<br /><span class="marca">Sheephuber</span></h1>
        <h2>Cadastre-se agora</h2>
      </header>

      <form method="POST" action="" class="formulario-login">
        @csrf
        <fieldset class="grupo-campos">
          <input
            type="text"
            name="nome"
            placeholder="Nome"
            value="{{ old('nome') }}"
            required
          />
          @error('nome')
            <div class="error">{{ $message }}</div>
          @enderror

          <input
            type="email"
            name="email"
            placeholder="E-mail"
            value="{{ old('email') }}"
            required
          />
          @error('email')
            <div class="error">{{ $message }}</div>
          @enderror

          <input
            type="text"
            name="cpf"
            placeholder="CPF"
            value="{{ old('cpf') }}"
            maxlength="14"
            pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
            title="Digite o CPF no formato 000.000.000-00"
            required
          />
          @error('cpf')
            <div class="error">{{ $message }}</div>
          @enderror

          <input
            type="password"
            name="senha"
            placeholder="Senha"
            required
          />
          @error('senha')
            <div class="error">{{ $message }}</div>
          @enderror

          <input
            type="password"
            name="senha_confirmation"
            placeholder="Confirmar senha"
            required
          />
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
