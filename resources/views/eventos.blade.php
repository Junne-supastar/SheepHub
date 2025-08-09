<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SheepHub - Eventos</title>
  <link rel="stylesheet" href="css/eventos.css>
</head>
<body>
  <aside class="sidebar">
    <br>
    <div class="logo">
      <div class="ligo">
        <img src="{{ asset('img/ovelha.png') }}" alt="SheepHub Logo" class="ovelha">
        <p class="shep">SheepHub</p>
      </div>
      <hr>
    </div>
    <nav>
      <ul>
        <br><br>
        <li><img src="{{ asset('img/homebranca.png') }}" alt="" class="icones"><a href="feed2.html">Feed</a></li>
        <br>
        <li><img src="{{ asset('img/mensages.png') }}" alt="" class="icones"><a href="mensagem.html">Mensagens</a></li>
        <br>
        <li><img src="{{ asset('img/eventospreto.png') }}" alt="" class="icones"><a href="eventos.html" id="iconescuro">Eventos</a></li>
        <br>
        <li><img src="{{ asset('img/greja.png') }}" alt="" class="icones"><a href="#">Igrejas</a></li>
        <br>
        <li><img src="{{ asset('img/perfil.png') }}" alt="" class="icones"><a href="perfil.html">Meu Perfil</a></li>
        <br>
        <li><button class="postar"><a href="#">Postar</a></button></li>
        <hr><br>
        <li><img src="{{ asset('img/config.png') }}" alt="" class="icones"><a href="#">Configurações</a></li>
        <br>
        <li><img src="{{ asset('img/sair.png') }}" alt="" class="icones"><a href="#">Sair</a></li>
      </ul>
    </nav>
  </aside>

  <div class="main-content">
    <header class="top-bar">
      <input type="search" placeholder="Pesquisar" class="pesquisa">
      <img src="{{ asset('img/Vector.png') }}" alt="" class="lupa">
      <div class="user-info">
        <img src="{{ asset('img/clara.png') }}" alt="User Avatar">
        <span>Clara Silva</span>
      </div>
    </header>

    <div class="content-wrapper">
      <section class="cards">
        <div class="car">
          <div class="card">
            <img src="{{ asset('img/jesus.png') }}" alt="Imagem do Card" class="card-img">
            <div class="card-content">
              <h2 class="card-title">Retiro de jovens! <p class="horario">10/07 - 19h</p></h2>
              <p class="card-text">Se increva para o retiro de jovens da primeira igreja batista em madureira!!!</p>
              <div class="baixo">
                <img src="{{ asset('img/fotinho.png') }}" alt="" class="fotinho">
                <div class="textos">
                  <h2 class="pib">PIB Madureira</h2>
                  <p class="data">18 de agosto</p>
                </div>
                <figure><img src="{{ asset('img/card icon.png') }}" alt="" class="favoritos"></figure>
              </div>
            </div>
          </div>

          <div class="card">
            <img src="{{ asset('img/jesus.png') }}" alt="Imagem do Card" class="card-img">
            <div class="card-content">
              <h2 class="card-title">Retiro de jovens! <p class="horario">10/07 - 19h</p></h2>
              <p class="card-text">Se increva para o retiro de jovens da primeira igreja batista em madureira!!!</p>
              <div class="baixo">
                <img src="{{ asset('img/fotinho.png') }}" alt="" class="fotinho">
                <div class="textos">
                  <h2 class="pib">PIB Madureira</h2>
                  <p class="data">18 de agosto</p>
                </div>
                <figure><img src="{{ asset('img/card icon.png') }}" alt="" class="favoritos"></figure>
              </div>
            </div>
          </div>

          <div class="card">
            <img src="{{ asset('img/jesus.png') }}" alt="Imagem do Card" class="card-img">
            <div class="card-content">
              <h2 class="card-title">Retiro de jovens! <p class="horario">10/07 - 19h</p></h2>
              <p class="card-text">Se increva para o retiro de jovens da primeira igreja batista em madureira!!!</p>
              <div class="baixo">
                <img src="{{ asset('img/fotinho.png') }}" alt="" class="fotinho">
                <div class="textos">
                  <h2 class="pib">PIB Madureira</h2>
                  <p class="data">18 de agosto</p>
                </div>
                <figure><img src="{{ asset('img/card icon.png') }}" alt="" class="favoritos"></figure>
              </div>
            </div>
          </div>
        </div>

        <div class="car">
          <div class="card">
            <img src="{{ asset('img/jesus.png') }}" alt="Imagem do Card" class="card-img">
            <div class="card-content">
              <h2 class="card-title">Retiro de jovens! <p class="horario">10/07 - 19h</p></h2>
              <p class="card-text">Se increva para o retiro de jovens da primeira igreja batista em madureira!!!</p>
              <div class="baixo">
                <img src="{{ asset('img/fotinho.png') }}" alt="" class="fotinho">
                <div class="textos">
                  <h2 class="pib">PIB Madureira</h2>
                  <p class="data">18 de agosto</p>
                </div>
                <figure><img src="{{ asset('img/card icon.png') }}" alt="" class="favoritos"></figure>
              </div>
            </div>
          </div>

          <div class="card">
            <img src="{{ asset('img/jesus.png') }}" alt="Imagem do Card" class="card-img">
            <div class="card-content">
              <h2 class="card-title">Retiro de jovens! <p class="horario">10/07 - 19h</p></h2>
              <p class="card-text">Se increva para o retiro de jovens da primeira igreja batista em madureira!!!</p>
              <div class="baixo">
                <img src="{{ asset('img/fotinho.png') }}" alt="" class="fotinho">
                <div class="textos">
                  <h2 class="pib">PIB Madureira</h2>
                  <p class="data">18 de agosto</p>
                </div>
                <figure><img src="{{ asset('img/card icon.png') }}" alt="" class="favoritos"></figure>
              </div>
            </div>
          </div>

          <div class="card">
            <img src="{{ asset('img/jesus.png') }}" alt="Imagem do Card" class="card-img">
            <div class="card-content">
              <h2 class="card-title">Retiro de jovens! <p class="horario">10/07 - 19h</p></h2>
              <p class="card-text">Se increva para o retiro de jovens da primeira igreja batista em madureira!!!</p>
              <div class="baixo">
                <img src="{{ asset('img/fotinho.png') }}" alt="" class="fotinho">
                <div class="textos">
                  <h2 class="pib">PIB Madureira</h2>
                  <p class="data">18 de agosto</p>
                </div>
                <figure><img src="{{ asset('img/card icon.png') }}" alt="" class="favoritos"></figure>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Mensagens -->
      <section class="messages">
        <div class="messages-header">
          <h2>Mensagens</h2>
        </div>
        <div class="conversations">
          <br>
          <div class="conversation">
            <img src="{{ asset('img/modelo2.png') }}" alt="Avatar João">
            <div class="conversation-info">
              <span class="conversation-name">Bernardo Cota</span>
              <span class="last-message">Olá, tudo bem?</span>
            </div>
          </div>
          <br>
          <div class="conversation">
            <img src="{{ asset('img/modelo1.png') }}" alt="Avatar Maria">
            <div class="conversation-info">
              <span class="conversation-name">Maria Souza</span>
              <span class="last-message">Vamos nos encontrar?</span>
            </div>
          </div>
          <br>
          <div class="conversation">
            <img src="{{ asset('img/andreia.png') }}" alt="Avatar Andreia">
            <div class="conversation-info">
              <span class="conversation-name">Andreia Lima</span>
              <span class="last-message">Fizemos uma oração por...</span>
            </div>
          </div>
          <br>
          <div class="conversation">
            <img src="{{ asset('img/souza.png') }}" alt="Avatar Souza">
            <div class="conversation-info">
              <span class="conversation-name">Gabriel Souza</span>
              <span class="last-message">Vai ao culto hoje?</span>
            </div>
          </div>
        </div>
        <br>
        <h2 class="minis">Ministerios</h2>
        <br>
        <div class="conversation" id="grupos">
          <img src="{{ asset('img/cruzazul.png') }}" alt="Avatar Cruz">
          <div class="conversation-info">
            <span class="conversation-name">Grupo Nazateen</span>
            <span class="last-message">Amanda: Pessoal, temos que...</span>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
</html>
