{{-- resources/views/dashboard/demandas.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - Finanças</title>
    <link rel="stylesheet" href="css/dashboard.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <div class="escuro"></div>

    <div class="infos-membra">
        <div class="cor">
            <a href="{{ route('demandas.index') }}">X</a>
        </div>

        <div class="perfil">
            <i><img src="{{ asset('img/Ellipse 106.png') }}" alt="Foto de perfil Larissa Leal" /></i>
            <h3>{{ $membroSelecionado->nome ?? 'Larissa Leal' }}</h3>
        </div>

        <section id="comentário">
            <p>{{ $membroSelecionado->comentario ?? 'Como vocês sabem, tenho servido como professora da Escola Dominical com muita alegria e dedicação nos últimos cinco anos. Amo trabalhar com as crianças e sinto que esse ministério é um chamado que Deus colocou em minha vida. Mas tenho me sentido sobrecarregada e gostaria de ajuda da liderança.' }}</p>
        </section>
    </div>

    <section id="menu-lateral">
        <figure>
            <img src="{{ asset('img/logo_sozinha_branca1.png') }}" alt="Logo SheepHub" />
            <h1>SheepHub</h1>
        </figure>
        <hr />
        <div id="perfil">
            <img src="{{ asset('img/nico.jpg') }}" alt="Foto de Augustus" id="imgPerfil" />
            <h2>{{ auth()->user()->name ?? 'Augustus' }}</h2>
            <p>Líder Religioso</p>
        </div>
        <nav id="first-nav">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-home"></i>
                            <p>Home</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('notificacoes') }}" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-bell"></i>
                            <p>Notificações</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mensagens') }}" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-message-rounded-dots"></i>
                            <p>Mensagens</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('postar') }}" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-plus-circle"></i>
                            <p>Postar</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="item">
                        <i class="bx bxs-church selecionado"></i>
                        <p class="selecionado">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('perfil') }}" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-user"></i>
                            <p>Meu perfil</p>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
        <hr id="second-hr" />
        <nav id="second-nav">
            <ul>
                <li>
                    <a href="{{ route('configuracoes') }}" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-cog"></i>
                            <p>Configurações</p>
                        </div>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="item logout-btn">
                            <div class="nav-seleciona">
                                <i class="bx bx-log-out"></i>
                                <p>Sair</p>
                            </div>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </section>

    <main>
        <div id="welcome">
            <h3>Bem vindo, {{ auth()->user()->name ?? 'Augustus' }}!</h3>
            <h2 id="gradiente">Dashboard</h2>
        </div>

        <nav id="nav-paginas">
            <ul>
                <li><a href="{{ route('financas') }}">Dízimos e ofertas</a></li>
                <li><a href="{{ route('membros') }}">Membros</a></li>
                <li><a href="{{ route('demandas.index') }}" class="selected">Demandas</a></li>
            </ul>
        </nav>

        <h3 style="color: #1f3440; margin-top: 20px;">Demandas de membros</h3>
        <div class="cards">
            @foreach($demandas as $demanda)
                <figure class="card-demanda">
                    <i><img src="{{ asset('img/' . $demanda->foto) }}" alt="Foto de {{ $demanda->nome }}"></i>
                    <h2>{{ $demanda->nome }}</h2>
                    <a href="{{ route('demandas.show', $demanda->id) }}" class="botao">Ver Mais</a>
                </figure>
            @endforeach
            <div class="divisao">
                @foreach($demandasExtra as $demandaExtra)
                    <figure class="card-demanda">
                        <i><img src="{{ asset('img/' . $demandaExtra->foto) }}" alt="Foto de {{ $demandaExtra->nome }}"></i>
                        <h2>{{ $demandaExtra->nome }}</h2>
                        <a href="{{ route('demandas.show', $demandaExtra->id) }}" class="botao">Ver Mais</a>
                    </figure>
                @endforeach

                <fieldset class="aviso-card">
                    <legend><img src="{{ asset('img/Rectangle 4207aviso.png') }}" alt="Aviso"></legend>
                    <figure class="card-demanda">
                        <i><img src="{{ asset('img/Ellipse 106.png') }}" alt="Larissa Leal"></i>
                        <h2>Larissa Leal</h2>
                        <a href="{{ route('demandas.show', $larissa->id ?? '#') }}" class="botao">Ver Mais</a>
                    </figure>
                </fieldset>
            </div>
        </div>
    </main>

    <aside>
        <div id="view-area">
            <div>
                <figure><i><img src="{{ asset('img/nao-lida.png') }}" alt="Demanda não lida"></i></figure>
                <p><span id="red">{{ $demandasNaoLidasCount ?? 1 }}</span> demanda(s) não-lida(s).</p>
            </div>
            <div>
                <figure><i><img src="{{ asset('img/icone visto.png') }}" alt="Demandas lidas"></i></figure>
                <p><span id="blue">{{ $demandasLidasCount ?? 5 }}</span> demanda(s) lida(s).</p>
            </div>
        </div>

        <div id="demandas">
            <img src="{{ asset('img/total membros.png') }}" alt="Total de membros" id="total-membros" />
            <div class="membro">
                <h2>Larissa Real</h2>
                <div class="info">
                    <i><img src="{{ asset('img/Ellipse 106.png') }}" alt="Foto Larissa" /></i>
                    <p>30 anos | Grupo de Louvor</p>
                </div>
                <button>
                    <img src="{{ asset('img/icone visto.png') }}" alt="Ícone lida" />
                    <p>Lida</p>
                </button>
            </div>
        </div>
    </aside>
</body>

</html>
