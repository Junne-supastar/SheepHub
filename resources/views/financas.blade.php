 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Finanças</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- teste -->
    <section id="menu-lateral">
        <figure>
            <img src="{{ asset('img/logo_sozinha_branca1.png') }}" alt="" id="logo-menu">
            <h1>SheepHub</h1>
        </figure>

        <hr>

        <div id="perfil">
            <img src="{{ asset('img/nico.jpg') }}" alt="" id="imgPerfil">
            <h2>Augustus</h2>
            <p>Líder Religioso</p>
        </div>

        <nav id="first-nav">
            <ul>
                <li>
                    <a href="" class="item">
                        <div class="nav-seleciona">
                            <i class='bx bxs-home'></i>
                            <p>Home</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <div class="nav-seleciona">
                            <i class='bx bxs-bell'></i>
                            <p>Notificações</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <div class="nav-seleciona">
                            <i class='bx bxs-message-rounded-dots'></i>
                            <p>Mensagens</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <div class="nav-seleciona">
                            <i class='bx bxs-plus-circle'></i>
                            <p>Postar</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <i class='bx bxs-church selecionado' ></i>
                        <p class="selecionado">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <div class="nav-seleciona">
                            <i class='bx bxs-user' ></i>
                            <p>Meu perfil</p>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
        <hr id="second-hr">
                
        <nav id="second-nav">
            <ul>
                <li>
                    <a href="" class="item">
                        <div class="nav-seleciona">
                            <i class='bx bxs-cog' ></i>
                            <p>Configurações</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <div class="nav-seleciona">
                            <i class='bx bx-log-out' ></i>
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
                <li><a href="" class="selected">Dízimos e ofertas</a></li>
                <li><a href="">Membros</a></li>
                <li><a href="{{ asset('demandas.html') }}">Demandas</a></li>
            </ul>
        </nav>

        <div id="area-cards">
            <div class="card card-financas">
                <img class="iconefinanca" src="{{ asset('img/handmoney.png') }}" alt="">
                <h3>Renda Total</h3>
                <h2 class="valorfinanca">R$5,034</h2>
                <h3><span>+ 30%</span> mês passado</h3>
            </div>

            <div class="card card-financas">
                <img class="iconefinanca" src="{{ asset('img/money bag.png') }}" alt="">
                <h3>Renda Total</h3>
                <h2 class="valorfinanca">R$5,034</h2>
                <h3><span id="negativo">- 10%</span> mês passado</h3>
            </div>

            <div class="card card-financas">
                <img class="iconefinanca" src="{{ asset('img/Vector.png') }}" alt="">
                <h3>Renda Total</h3>
                <h2 class="valorfinanca">R$5,034</h2>
                <h3><span>+ 5%</span> mês passado</h3>
            </div>
        </div>

        <div id="grafico-area">
            <img src="{{ asset('img/gráfico.png') }}" alt="">
        </div>
    </main>

    <aside>
        <div id="atv-area">
            <img src="{{ asset('img/graficoatv.png') }}" alt="">
        </div>

        <div id="objetivos">
            <h2>Objetivos</h2>

            <div class="goal">
                <img src="{{ asset('img/martelo.png') }}" alt="">
                <div class="progresso">
                    <p>Melhora do templo</p>
                    <progress value="70" max="100">70 %</progress>
                    <p>R$ 1236,50 restantes</p>
                </div>

                <div class="porcentagem">
                    <p>70%</p>
                </div>
            </div>

            <div class="goal">
                <img src="{{ asset('img/viagem.png') }}" alt="">
                <div class="progresso">
                    <p>Viagem missionária</p>
                    <progress value="70" max="100">70 %</progress>
                    <p>R$ 1236,50 restantes</p>
                </div>
    
                <div class="porcentagem">
                    <p>70%</p>
                </div>
            </div>
        </div>
    </aside>

</body>
</html>
