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
    <!-- teste -->
    <section id="menu-lateral">
        <figure>
            <img src="{{ asset('img/logo_sozinha_branca1.png') }}" alt="" id="logo-menu" />
            <h1>SheepHub</h1>
        </figure>

        <hr />

        <div id="perfil">
            <img src="{{ asset('img/nico.jpg') }}" alt="" id="imgPerfil" />
            <h2>Augustus</h2>
            <p>Líder Religioso</p>
        </div>

        <nav id="first-nav">
            <ul>
                <li>
                    <a href="#" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-home"></i>
                            <p>Home</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-bell"></i>
                            <p>Notificações</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-message-rounded-dots"></i>
                            <p>Mensagens</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-plus-circle"></i>
                            <p>Postar</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <i class="bx bxs-church selecionado"></i>
                        <p class="selecionado">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
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
                    <a href="#" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bxs-cog"></i>
                            <p>Configurações</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="nav-seleciona">
                            <i class="bx bx-log-out"></i>
                            <p>Sair</p>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </section>

    <main>
        <div id="welcome">
            <h3>Bem vindo, Augustus!</h3>
            <h2 id="gradiente">Dashboard</h2>
        </div>

        <nav id="nav-paginas">
            <ul>
                <li><a href="{{ route('financas') }}">Dízimos e ofertas</a></li>
                <li><a href="#">Membros</a></li>
                <li><a href="{{ route('demandas') }}" class="selected">Demandas</a></li>
            </ul>
        </nav>
        <h3 style="color: #1f3440; margin-top: 20px;"> Demandas de membros </h3>

        <div class="cards">
            <figure class="card-demanda">
                <i><img src="{{ asset('img/Ellipse 106-1.png') }}" alt="" /></i>
                <h2>Carlos Mario</h2>
                <a href="#" class="botao"> Ver Mais</a>
            </figure>
            <figure class="card-demanda">
                <i><img src="{{ asset('img/Ellipse 106-2.png') }}" alt="" /></i>
                <h2>Vivi Fonseca</h2>
                <a href="#" class="botao"> Ver Mais</a>
            </figure>
            <figure class="card-demanda">
                <i><img src="{{ asset('img/Ellipse 106-3.png') }}" alt="" /></i>
                <h2>Bob Shawn</h2>
                <a href="#" class="botao">Ver Mais</a>
            </figure>

            <figure class="card-demanda">
                <i><img src="{{ asset('img/Ellipse 106-4.png') }}" alt="" /></i>
                <h2>Lucy Mont</h2>
                <a href="#" class="botao">Ver Mais</a>
            </figure>
            <figure class="card-demanda">
                <i><img src="{{ asset('img/Ellipse 106-5.png') }}" alt="" /></i>
                <h2>Yuri Amorim</h2>
                <a href="#" class="botao">Ver Mais</a>
            </figure>
            <figure class="card-demanda">
                <i><img src="{{ asset('img/Ellipse 106.png') }}" alt="" /></i>
                <h2>Larissa Leal</h2>
                <a href="#" class="botao">Ver Mais</a>
            </figure>
        </div>
    </main>

    <aside>
        <div id="view-area">
            <div>
                <figure><i><img src="{{ asset('img/nao-lida.png') }}" alt="" /></i></figure>
                <p><span id="red">1</span>demanda não-lida.</p>
            </div>
            <div>
                <figure><i><img src="{{ asset('img/icone visto.png') }}" alt="" /></i></figure>
                <p><span id="blue">5</span>demandas lidas.</p>
            </div>
        </div>

        <div id="demandas">
            <img src="{{ asset('img/total membros.png') }}" alt="" id="total-membros" />

            <div class="membro">
                <h2>Larissa Leal</h2>
                <div class="info">
                    <i><img src="{{ asset('img/Ellipse 106.png') }}" alt="" /></i>
                    <p>30 anos | Grupo de Louvor</p>
                </div>
                <button><img src="{{ asset('img/icone visto.png') }}" alt="" /><p>Lida</p></button>
            </div>
        </div>
    </aside>
</body>

</html>
