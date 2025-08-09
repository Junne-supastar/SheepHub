<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Escolha seu Cadastro</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/login.css' />
</head>
<body>
  <main class="conteudo-principal">
    <section class="painel-esquerdo">
      {{-- Conteúdo opcional --}}
    </section>

    <section class="painel-direito">
      <header class="cabecalho-login">
        <h1>Olá!<br /><span class="marca">Sheephuber</span></h1>
        <h2>Desejo me cadastrar como</h2>
      </header>

      <a href="{{ route('usuario.cadastro') }}">
        <button type="button" class="botao-usuario">Usuário</button>
      </a>
      <a href="{{ route('lider.cadastro') }}">
        <button type="button" class="botao-igreja">Líder Religioso</button>
      </a>

      <p class="texto-cadastro">
          Já possui uma conta? <a href="{{ route('login') }}">Faça Login</a>
      </p>
    </section>
  </main>
</body>
</html>
