@extends('layouts.app')
<link rel="stylesheet" href="css/perfil.css">
@section('title', 'Perfil - SheepHub')

<section class="conteudo">
  <form class="content-wrapper">
    <div class="perfil">
      <img src="{{ asset('img/fotodeperfil.png') }}" alt="" class="fotinho" />
      <div class="textos">
        <div class="test">
          <p> Augustus Nicodemus</p>
          <p class="nick">@nicodemus</p>
        </div>
        <p class="residente">
          <a href="https://www.google.com/maps?q=1ª Igreja do Nazareno em Nilópolis" target="_blank">
            <img src="{{ asset('img/igreja.png') }}" alt="" class="iconeigrj" />
          <
          <a href="https://www.google.com/maps?q=1ª Igreja do Nazareno em Nilópolis" target="_blank" class="nomeigreja">
            Primeira Igreja do Nazareno em Nilópolis
          </a>
        </p>
      </div>
    </div>
    <div class="quantidade">
      <p class="post1">19 postagens</p>
      <p class="seguindo">26 seguindo</p>
      <p>204 membros</p>
    </div>
  </form>

  <br /><br />

  <div class="containe">
    <div class="headeri">
      <h2 class="title" id="selected">Postagens</h2>
      <p class="subtitle">Marcados</p>
    </div>
    <div class="grid">
      <div class="post">
        <img src="{{ asset('img/reunião.png') }}" alt="Grupo de pessoas" class="prime" />
        <img src="{{ asset('img/palestra.png') }}" alt="Homem falando no púlpito" class="segu" />
        <img src="{{ asset('img/roda.png') }}" alt="pessoas se abraçando" class="terc" />
      </div>
      <div class="posti">
        <img src="{{ asset('img/estatua.png') }}" alt="" class="quat" />
        <img src="{{ asset('img/orando.png') }}" alt="Pessoas fazendo exercícios" class="quint" />
        <img src="{{ asset('img/livro.png') }}" alt="" class="sext" />
      </div>
    </div>
  </div>
</section>

<section class="messages">
  <div class="messages-header">
    <h2>Mensagens</h2>
  </div>
  <div class="conversations">
    <div class="conversation">
      <img src="{{ asset('imgfeed/modelo2.png') }}" alt="Avatar João" />
      <div class="conversation-info">
        <span class="conversation-name">Bernardo Cota</span>
        <span class="last-message">Olá, tudo bem?</span>
      </div>
    </div>
    <div class="conversation">
      <img src="{{ asset('imgfeed/modelo1.png') }}" alt="Avatar Maria" />
      <div class="conversation-info">
        <span class="conversation-name">Maria Souza</span>
        <span class="last-message">Vamos nos encontrar?</span>
      </div>
    </div>
    <div class="conversation">
      <img src="{{ asset('imgfeed/andreia.png') }}" alt="Avatar Andreia" />
      <div class="conversation-info">
        <span class="conversation-name">Andreia Lima</span>
        <span class="last-message">Fizemos uma oração por...</span>
      </div>
    </div>
    <div class="conversation">
      <img src="{{ asset('imgfeed/souza.png') }}" alt="Avatar Souza" />
      <div class="conversation-info">
        <span class="conversation-name">Gabriel Souza</span>
        <span class="last-message">Vai ao culto hoje?</span>
      </div>
    </div>
  </div>

  <h2 class="minis">Ministerios</h2>
  <div class="conversation" id="grupos">
    <img src="{{ asset('imgfeed/cruzazul.png') }}" alt="Avatar Cruz" />
    <div class="conversation-info">
      <span class="conversation-name">Grupo Nazateen</span>
      <span class="last-message">Amanda: Pessoal, temos que...</span>
    </div>
  </div>
</section>
@endsection
