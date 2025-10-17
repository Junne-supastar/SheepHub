<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Verifica se usuário está logado
if (!isset($_SESSION['idusuario'])) {
    header('Location: /SheepHub/public/index.php');
    exit;
}

// Informações do usuário
$nivel = $_SESSION['nivel'] ?? 0;
$nome_usuario = $_SESSION['nome'] ?? 'Usuário';
$avatar_usuario = $_SESSION['avatar'] ?? '../assets/img/user-icon-sidebar.jpg';

// Página atual para destacar menu
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../assets/css/sidebar.css">

<header class="main-header">
    <div class="header-left">
        <a href="feed2.php" class="logo"></a>
    </div>

    <div class="header-center">
        <div class="search-bar">
            <input type="search" placeholder="Pesquisar na rede..." id="inputSearch">
            <div class="icon-search"></div>
        </div>
        <div class="icon-center">
            <div class="cont-icon-center">
                <a href="#">
                    <div class="item" id="item01">
                        <img src="../assets/img/vetor10-sidebar.svg" alt="">
                        <span class="notification-badge">5</span>
                    </div>
                </a>
                <a href="#">
                    <div class="item" id="item02">
                        <img src="../assets/img/vetor05-sidebar.svg" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="header-right">
        <div class="user-info">
            <div class="user-header">
                <a href="#"><h5><?= htmlspecialchars($nome_usuario) ?></h5></a>
                <a href="#"><p>
                    <?= ($nivel == 4 ? 'Membro' : ($nivel == 2 ? 'Instituição' : ($nivel == 1 ? 'Admin' : 'Visitante'))) ?>
                </p></a>
            </div>
            <div class="profile-user">
                <img src="<?= htmlspecialchars($avatar_usuario) ?>" alt="Meu Perfil" class="avatar">
            </div>
        </div>
    </div>
</header>

<aside class="sidebar" id="menu-lateral">
    <nav>
        <div class="logo-sidebar">
            <img src="../assets/img/logo-sheephub-menu.png" alt="logo">
        </div>
        <div class="linha"></div>
        <ul>
            <li class="<?= ($currentPage == 'feed2.php') ? 'active' : '' ?>">
                <a href="feed2.php"><i class="fa-solid fa-house"></i> Feed</a>
            </li>
            <li class="<?= ($currentPage == 'perfil.php') ? 'active' : '' ?>">
                <a href="perfil.php"><i class="fa-solid fa-user"></i> Meu Perfil</a>
            </li>

            <?php if ($nivel == 5): // Visitante ?>
                <li class="<?= ($currentPage == 'eventos.php') ? 'active' : '' ?>"><a href="eventos.php"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>
                <li><a href="#"><i class="fa-solid fa-church"></i> Igrejas</a></li>
                <li class="<?= ($currentPage == 'postar.php') ? 'active' : '' ?>"><a href="postar.php"><i class="fa-solid fa-plus"></i> Postar</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>
                <li><a href="/SheepHub/public/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>

            <?php elseif ($nivel == 4): // Membro ?>
                <li class="<?= ($currentPage == 'eventos02.php') ? 'active' : '' ?>"><a href="eventos02.php"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>
                <li class="<?= ($currentPage == 'mensagem.php') ? 'active' : '' ?>"><a href="mensagem.php"><i class="fa-solid fa-comments"></i> Mensagens</a></li>
                <li class="<?= ($currentPage == 'minhainst.php') ? 'active' : '' ?>"><a href="minhainst.php"><i class="fa-solid fa-landmark"></i> Minha Instituição</a></li>
                <li><a href="#"><i class="fa-solid fa-church"></i> Igrejas</a></li>
                <li class="<?= ($currentPage == 'postar.php') ? 'active' : '' ?>"><a href="postar.php"><i class="fa-solid fa-plus"></i> Postar</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>
                <li><a href="/SheepHub/public/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>

            <?php elseif ($nivel == 2): // Instituição ?>
                <li><a href="/SheepHub/views/dashboard/dashboard_financas.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><a href="/SheepHub/views/dashboard/caixinha/caixinha.php"><i class="fa-solid fa-wallet"></i> Finanças</a></li>
                <li><a href="/SheepHub/views/dashboard/Membros.php"><i class="fa-solid fa-users"></i> Membros</a></li>
                <li><a href="#"><i class="fa-solid fa-church"></i> Igrejas</a></li>
                <li><a href="mensagem.php"><i class="fa-solid fa-comments"></i> Mensagens</a></li>
                <li><a href="eventos02.php"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>
                <li class="<?= ($currentPage == 'postar.php') ? 'active' : '' ?>"><a href="postar.php"><i class="fa-solid fa-plus"></i> Postar</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>
                <li><a href="/SheepHub/public/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>

            <?php elseif ($nivel == 1): // Admin ?>
                <li><a href="SheepHub/dashboard_financas.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li><a href="financas.php"><i class="fa-solid fa-wallet"></i> Finanças</a></li>
                <li><a href="membros.php"><i class="fa-solid fa-users"></i> Membros</a></li>
                <li><a href="listarusuario.php"><i class="fa-solid fa-user-gear"></i> Usuário</a></li>
                <li><a href="#"><i class="fa-solid fa-church"></i> Igrejas</a></li>
                <li><a href="mensagem.php"><i class="fa-solid fa-comments"></i> Mensagens</a></li>
                <li><a href="eventos02.php"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>
                <li class="<?= ($currentPage == 'postar.php') ? 'active' : '' ?>"><a href="postar.php"><i class="fa-solid fa-plus"></i> Postar</a></li>
                <li><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>
                <li><a href="/SheepHub/public/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>
