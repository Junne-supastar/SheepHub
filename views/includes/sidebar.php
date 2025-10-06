<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Linha original comentada para não perdê-la
// $nivel = $_SESSION['nivel'] ?? 0; 

// FORÇANDO O NÍVEL PARA TESTE:
$nivel = 1; // <-- Mude este número para testar outros perfis (1 para Admin, 2 para Instituição, etc.)
$currentPage = 'exemplo.php';
// O resto do seu código continua normalmente...
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<header class="main-header">
    
    <div class="header-left">
        <a href="feed2.php" class="logo">
            
        </a>
    </div>

    <div class="header-center">
        <div class="search-bar">
            <input type="search" placeholder="Pesquisar na rede..." id="inputSearch">
            <div class="icon-search">
    
            </div>
        </div>
        <div class="icon-center">
            <div class="cont-icon-center">
                <a href="#">
                    <div class="item" id="item01">
                        <img src="../assets/img/vetor10-sidebar.svg" alt="">
                        <span class="notification-badge">5</span> </div>
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
                <a href="#">
                    <h5>Clara Silva</h5>
                </a>
                <a href="#">
                    <p>Membro</p>
                </a>
            </div>
            
            <div class="profile-user">
                <img src="../assets/img/user-icon-sidebar.jpg" alt="Meu Perfil" class="avatar">
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
    <?php
      // Itens de menu fixos que aparecem para todos
      ?>
      <li class="<?= ($currentPage == 'feed2.php') ? 'active' : '' ?>">
        <a href="feed2.php"><i class="fa-solid fa-house"></i> Feed</a>
      </li>
      <li class="<?= ($currentPage == 'perfil.php') ? 'active' : '' ?>">
        <a href="perfil.php"><i class="fa-solid fa-user"></i> Meu Perfil</a>
      </li>

      <?php
      if ($nivel == 5) { // Visitante
          echo '<li class="'.($currentPage == 'eventos.php' ? 'active' : '').'"><a href="eventos.php"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>';
          echo '<li><a href="#"><i class="fa-solid fa-church"></i> Igrejas</a></li>';
          echo '<li class="menu-postar-btn '.($currentPage == 'postar.php' ? 'active' : '').'"><a href="postar.php"><i class="fa-solid fa-plus"></i> Postar</a></li>';
          echo '<li><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>';
          echo '<li><a href="#"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>';

      } elseif ($nivel == 4) { // Membro
          echo '<li class="'.($currentPage == 'eventos.php' ? 'active' : '').'"><a href="eventos02.php"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>';
          echo '<li class="'.($currentPage == 'mensagem.php' ? 'active' : '').'"><a href="mensagem.php"><i class="fa-solid fa-comments"></i> Mensagens</a></li>';
          echo '<li class="'.($currentPage == 'minhainst.php' ? 'active' : '').'"><a href="minhainst.php"><i class="fa-solid fa-landmark"></i> Minha Instituição</a></li>';
          echo '<li><a href="#"><i class="fa-solid fa-church"></i> Igrejas</a></li>';
          echo '<li class="menu-postar-btn '.($currentPage == 'postar.php' ? 'active' : '').'"><a href="postar.php"><i class="fa-solid fa-plus"></i> Postar</a></li>';
          echo '<li><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>';
          echo '<li><a href="#"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>';

      } elseif ($nivel == 2) { // Instituição
        echo '<li class="menu-dashboard"><a href="dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>';
        echo '<li class="menu-financas"><a href="financas.php"><i class="fa-solid fa-wallet"></i> Finanças</a></li>';
        echo '<li class="menu-membros"><a href="membros.php"><i class="fa-solid fa-users"></i> Membros</a></li>';
        echo '<li class="menu-igrejas"><a href="#"><i class="fa-solid fa-church"></i> Igrejas</a></li>';
        echo '<li class="menu-mensagens"><a href="mensagem.php"><i class="fa-solid fa-comments"></i> Mensagens</a></li>';
        echo '<li class="menu-eventos"><a href="eventos02.php"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>';
        echo '<li class="menu-postar-btn '.($currentPage == 'postar.php' ? 'active' : '').'"><a href="postar.php"><i class="fa-solid fa-plus"></i> Postar</a></li>';
        echo '<li class="menu-config"><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>';
        echo '<li class="menu-sair"><a href="#"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>';

    } elseif ($nivel == 1) { // Admin
        echo '<li class="menu-dashboard"><a href="dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>';
        echo '<li class="menu-financas"><a href="financas.php"><i class="fa-solid fa-wallet"></i> Finanças</a></li>';
        echo '<li class="menu-membros"><a href="membros.php"><i class="fa-solid fa-users"></i> Membros</a></li>';
        echo '<li class="menu-usuarios"><a href="listarusuario.php"><i class="fa-solid fa-user-gear"></i> Usuário</a></li>';
        echo '<li class="menu-igrejas"><a href="#"><i class="fa-solid fa-church"></i> Igrejas</a></li>';
        echo '<li class="menu-mensagens"><a href="mensagem.php"><i class="fa-solid fa-comments"></i> Mensagens</a></li>';
        echo '<li class="menu-eventos"><a href="eventos02.php"><i class="fa-solid fa-calendar-days"></i> Eventos</a></li>';
        echo '<li class="menu-postar-btn '.($currentPage == 'postar.php' ? 'active' : '').'"><a href="postar.php"><i class="fa-solid fa-plus"></i> Postar</a></li>';
        echo '<li class="menu-config"><a href="#"><i class="fa-solid fa-gear"></i> Configurações</a></li>';
        echo '<li class="menu-sair"><a href="#"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>';
    }
      ?>
    </ul>
  </nav>
</aside>
