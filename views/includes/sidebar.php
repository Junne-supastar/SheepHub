<?php

if (session_status() === PHP_SESSION_NONE) session_start();
$nivel = $_SESSION['nivel'] ?? 0; // 0 = visitante, 1 = membro, 2 = igreja, 3 = líder religioso

function sidebarLink($href, $label) {
    echo "<li><a href=\"$href\">$label</a></li>";
}
?>
<aside class="sidebar">
  <nav>
    <ul>
      <?php
      // Feed e Perfil sempre aparecem
      sidebarLink('feed2.php', 'Feed');
      sidebarLink('perfil.php', 'Meu Perfil');

      if ($nivel == 0) { // Visitante
          sidebarLink('postar.php', 'Postar');
          sidebarLink('#', 'Igrejas');
          sidebarLink('#', 'Configurações');
          sidebarLink('#', 'Sair');
      } elseif ($nivel == 1) { // Membro
          sidebarLink('mensagem.php', 'Mensagens');
          sidebarLink('eventos.php', 'Eventos');
          sidebarLink('#', 'Igrejas');
          sidebarLink('#', 'Configurações');
          sidebarLink('#', 'Sair');
      } elseif ($nivel == 2) { // Igreja
          sidebarLink('dashboard.php', 'Dashboard');
          sidebarLink('#', 'Igrejas');
          sidebarLink('eventos.php', 'Eventos');
          sidebarLink('postar.php', 'Postar');
          sidebarLink('#', 'Configurações');
          sidebarLink('#', 'Sair');
      } elseif ($nivel == 3) { // Líder religioso
          sidebarLink('dashboard.php', 'Dashboard');
          sidebarLink('eventos.php', 'Eventos');
          sidebarLink('mensagem.php', 'Mensagens');
          sidebarLink('postar.php', 'Postar');
          sidebarLink('#', 'Igrejas');
          sidebarLink('#', 'Configurações');
          sidebarLink('#', 'Sair');
      }
      ?>
    </ul>
  </nav>
</aside>

