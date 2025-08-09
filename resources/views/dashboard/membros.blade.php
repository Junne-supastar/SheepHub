<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - Membros</title>
    <link rel="stylesheet" href="{{ asset('css/membros.css') }}" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <header id="menu-lateral">
        <figure>
            <img src="{{ asset('img/logo_sozinha_branca1.png') }}" alt="" />
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
                    <a href="{{ route('home') }}" class="item">
                        <i class='bx bxs-home'></i>
                        <p>Home</p>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <i class='bx bxs-bell'></i>
                        <p>Notificações</p>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <i class='bx bxs-message-rounded-dots'></i>
                        <p>Mensagens</p>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <i class='bx bxs-plus-circle'></i>
                        <p>Postar</p>
                    </a>
                </li>
                <li>
                    <a href="" id="selecionado" class="item">
                        <i class='bx bxs-church'></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="" class="item">
                        <i class='bx bxs-user'></i>
                        <p>Meu perfil</p>
                    </a>
                </li>
            </ul>
        </nav>

        <hr id="second-hr" />

        <nav id="second-nav">
            <ul>
                <li>
                    <a href="" class="item">
                        <i class='bx bxs-cog'></i>
                        <p>Configurações</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="item">
                        <i class='bx bx-log-out'></i>
                        <p>Sair</p>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="titulo">
            <h3 class="sub-titulo">Bem vindo, Augustus!</h3>
            <h2 class="gradiente">Dashboard</h2>
        </section>

        <section id="nav-pags">
            <ul>
                <li><a href="">Dízimos e ofertas</a></li>
                <li><a href="" class="selected">Membros</a></li>
                <li><a href="">Demandas</a></li>
            </ul>
        </section>

        <section id="member-list">
            <h2>Lista de membros</h2>

            <table>
                <tr id="table-header">
                    <th><img src="{{ asset('img/selecionar.png') }}" alt="" /></th>
                    <td>Foto</td>
                    <td>Nome</td>
                    <td>Idade</td>
                    <td>Frequência</td>
                    <td>Ministério</td>
                    <td class="td-final">Controle</td>
                </tr>
                <tr class="membros-linha">
                    <th><img src="{{ asset('img/selecionar.png') }}" alt="" /></th>
                    <td><img class="membros-foto" src="{{ asset('img/Ellipse 81.png') }}" alt="" /></td>
                    <td>Emanuelle Tomaz</td>
                    <td>16</td>
                    <td>90%</td>
                    <td>Pregação</td>
                    <td class="td-final"> <a href="#"><img src="{{ asset('img/add.png') }}" alt="" /></a> </td>
                </tr>
                <tr class="membros-linha">
                    <th><img src="{{ asset('img/selecionar.png') }}" alt="" /></th>
                    <td><img class="membros-foto" src="{{ asset('img/Ellipse 81 (1).png') }}" alt="" /></td>
                    <td>Gustavo Silva</td>
                    <td>17</td>
                    <td>70%</td>
                    <td>Teatro</td>
                    <td class="td-final"> <a href="#"><img src="{{ asset('img/add.png') }}" alt="" /></a> </td>
                </tr>
                <tr class="membros-linha">
                    <th><img src="{{ asset('img/selecionar.png') }}" alt="" /></th>
                    <td><img class="membros-foto" src="{{ asset('img/Ellipse 81 (2).png') }}" alt="" /></td>
                    <td>Julianne Parga</td>
                    <td>17</td>
                    <td>75%</td>
                    <td>Dança</td>
                    <td class="td-final"> <a href="#"><img src="{{ asset('img/add.png') }}" alt="" /></a> </td>
                </tr>
                <tr class="membros-linha">
                    <th><img src="{{ asset('img/selecionar.png') }}" alt="" /></th>
                    <td><img class="membros-foto" src="{{ asset('img/Ellipse 81 (5).png') }}" alt="" /></td>
                    <td>Breno Pessôa</td>
                    <td>21</td>
                    <td>60%</td>
                    <td>Louvor</td>
                    <td class="td-final"> <a href="#"><img src="{{ asset('img/add.png') }}" alt="" /></a> </td>
                </tr>
                <tr class="membros-linha">
                    <th><img src="{{ asset('img/selecionar.png') }}" alt="" /></th>
                    <td><img class="membros-foto" src="{{ asset('img/Ellipse 81 (3).png') }}" alt="" /></td>
                    <td>Jonathas Oliveira</td>
                    <td>28</td>
                    <td>80%</td>
                    <td>Coral</td>
                    <td class="td-final"> <a href="#"><img src="{{ asset('img/add.png') }}" alt="" /></a> </td>
                </tr>
                <tr class="membros-linha">
                    <th><img src="{{ asset('img/selecionar.png') }}" alt="" /></th>
                    <td><img class="membros-foto" src="{{ asset('img/Ellipse 81 (4).png') }}" alt="" /></td>
                    <td>Fernanda Leal</td>
                    <td>33</td>
                    <td>55%</td>
                    <td>Teatro</td>
                    <td class="td-final"> <a href="#"><img src="{{ asset('img/add.png') }}" alt="" /></a></td>
                </tr>
            </table>
        </section>
    </main>

    <aside>
        <h1>
            <b>40</b> Membros totais
        </h1>
        <img id="frequencia-img" src="{{ asset('img/frequencia de membros.png') }}" alt="" />
        <img id="total-img" src="{{ asset('img/total membros.png') }}" alt="" />
    </aside>
</body>

</html>
