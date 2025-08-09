<link rel="stylesheet" href=""{{ asset('css/style.css') }}.css">
<div class="logo">
  <div class="ligo">
    <img src="{{ asset('imgfeed/ovelha.png') }}" alt="SheepHub Logo" class="ovelha">
    <p class="shep">SheepHub</p>
  </div>
  <hr>
</div>
<nav>
  <ul>
    <li><img src="{{ asset('imgfeed/homebranca.png') }}" alt="" class="icones"><a href="{{ route('feed') }}">Feed</a></li>
    <li><img src="{{ asset('imgfeed/mensages.png') }}" alt="" class="icones"><a href="{{ route('mensagens') }}">Mensagens</a></li>
    <li><img src="{{ asset('imgfeed/eventos.png') }}" alt="" class="icones"><a href="{{ route('eventos') }}">Eventos</a></li>
    <li><img src="{{ asset('imgfeed/greja.png') }}" alt="" class="icones"><a href="{{ route('igrejas') }}">Igrejas</a></li>
    <li><img src="{{ asset('imgfeed/perfilescuro.png') }}" alt="" class="icones"><a href="{{ route('perfil') }}" id="iconescuro">Meu Perfil</a></li>
    <li><button class="postar"><a href="{{ route('postar') }}">Postar</a></button></li>
    <hr>
    <li><img src="{{ asset('imgfeed/config.png') }}" alt="" class="icones"><a href="{{ route('configuracoes') }}">Configurações</a></li>
    <li><img src="{{ asset('imgfeed/sair.png') }}" alt="" class="icones"><a href="{{ route('logout') }}">Sair</a></li>
  </ul>
</nav>
