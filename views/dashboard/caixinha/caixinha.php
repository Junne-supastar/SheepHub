  <?php

  
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  

$mensagem_sucesso = $_SESSION['mensagem_sucesso'] ?? null;
$mensagem_erro = $_SESSION['mensagem_erro'] ?? null;
unset($_SESSION['mensagem_sucesso'], $_SESSION['mensagem_erro']);


  if (!isset($_SESSION['idusuario'])) {
      // Redireciona para a página pública (login)
      header("Location: /SheepHub/public/index.php");
      exit;
  }

  require_once __DIR__ . '/../../../controllers/CaixinhaController.php';


  $controller = new CaixinhaController();
  $idUsuario = $_SESSION['idusuario'] ?? null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'criar') {
      if ($idUsuario) {
          $controller->criarCaixinha([
              'idusuario_instituicao' => $idUsuario,
              'nome' => $_POST['nome_caixinha'],
              'meta' => $_POST['meta_caixinha']
          ]);
      } else {
          echo "Você precisa estar logado para criar uma caixinha.";
          exit;
      }
  }

  // Listar caixinhas
  $caixinhas = $controller->listarCaixinhas($idUsuario);

  $totalArrecadado = 0;
if (!empty($caixinhas)) {
    foreach ($caixinhas as $caixinha) {
        $totalArrecadado += floatval($caixinha['total']);
    }
}

  
  ?>


  <!DOCTYPE html>
  <html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixinha Igreja Church</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-a5xw+4LxU0YrKjW/s1nyzVSkPBgKfqWrGrzJ8e/v2O0zPNMgD6q+Z6x4R5k1M4X9Lmz8mG63N5iWPh4Fz+0M5Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="/SheepHub/views/assets/css/caixinha.css">
  <script src="/SheepHub/views/assets/js/caixinha.js" defer></script>



  </head>
  <body>

    <aside id="menu_lateral" class="menu_lateral">
      <a href="#" class="logo"><span>SheepHub</span></a>
      <nav>
        <a href="#" class="link_nav"><span>Feed</span></a>
        <a href="#" class="link_nav"><span>Mensagens</span></a>
        <a href="#" class="link_nav ativo"><span>Eventos</span></a>
        <a href="#" class="link_nav"><span>Igrejas</span></a>
        <a href="#" class="link_nav"><span>Meu perfil</span></a>
        <a href="#" class="link_nav"><span>Painel</span></a>
        <button class="btn_postar">Postar</button>
      </nav>
      <div>
        <a href="#" class="link_nav"><span>Configurações</span></a>
        <a href="#" class="link_nav"><span>Sair</span></a>
      </div>
    </aside>

    <div class="conteudo">
   <?php if ($mensagem_sucesso): ?>
  <script>alert("<?= addslashes($mensagem_sucesso) ?>");</script>
<?php endif; ?>

<?php if ($mensagem_erro): ?>
  <script>alert("<?= addslashes($mensagem_erro) ?>");</script>
<?php endif; ?>

      <header class="cabecalho">
        <div class="busca_box">
          <input type="text" placeholder="Pesquisar eventos..." class="campo_busca">
        </div>
        <div class="perfil_info">
          <div class="perfil_texto">
              <p><strong>usu</strong></p>
                          <p style="font-size: 0.8rem; color: var(--cor-texto-secundario)">Líder</p>
          </div>
          <img src="https://placehold.co/40x40/E2E8F0/4A5568?text=CS" alt="Avatar de Clara Silva">
        </div>
      </header>

        <div class="area_eventos">
          <div class="container">
            <header class="cabecalho_pagina">
              <h1 class="titulo_pagina">Caixinha Igreja Church</h1>
            <p class="total_pagina">Total arrecadado: <strong>R$ <?= number_format($totalArrecadado, 2, ',', '.') ?></strong></p>

            </header>

          <main class="grade_cartao">
    <?php if (!empty($caixinhas)): ?>
      <?php foreach ($caixinhas as $caixinha): ?>
            <div class="cartao" data-id="<?= $caixinha['id_caixinha'] ?>">


              <div class="topo_cartao">
                  <h2 class="titulo_cartao"><?= htmlspecialchars($caixinha['nome']) ?></h2>

  <p class="total_cartao">Total: R$<?= number_format($caixinha['total'], 2, ',', '.') ?></p>

              </div>

              <div class="meta_cartao">
                <span>Meta</span>
                  <span>R$<?= number_format($caixinha['meta'], 2, ',', '.') ?></span>
              </div>

                    <?php
            // Calcula porcentagem da barra de progresso
            $percentual = ($caixinha['meta'] > 0)
                ? min(100, ($caixinha['total'] / $caixinha['meta']) * 100)
                : 0;
          ?>

              <div class="barra_progresso">
                 <div class="progresso" style="width: <?= $percentual ?>%;"></div>
              </div>

              <div class="acoes_cartao">
            <!-- Botão para contribuir -->
            <button class="btn btn_primario" onclick="abrirModalContribuir('<?= htmlspecialchars($caixinha['nome']) ?>', <?= $caixinha['id_caixinha'] ?>)">
              <img src="/SheepHub/views/assets/img/coracao-caixinha.png" alt=""> Contribuir
            </button>
                    <!-- Botão para retirar -->
            <button class="btn btn_secundario" onclick="abrirModalRetirar('<?= htmlspecialchars($caixinha['nome']) ?>', <?= $caixinha['id_caixinha'] ?>)">
              <img src="/SheepHub/views/assets/img/vetor-caixinha.png" alt="">
            </button>
              </div>

            </div>
      <?php endforeach; ?>
      <?php endif; ?> 
          

      
        
              <!-- Cartão para criar nova caixinha -->
    <div class="cartao_add" onclick="abrirModalCriar()">
      <div class="icone_add"><span>+</span></div>
    </div>

          </main>
        </div>
      </div>
    </div>

    <div class="fundo_modal" data-fechar-modal></div>

    <div class="modal">
      <div class="topo_modal">
        <h2>Criar Nova Caixinha</h2>
        <button class="fechar_modal" data-fechar-modal>&times;</button>
      </div>
      <div class="corpo_modal">
        <form action="" method="post">
          <input type="hidden" name="acao" value="criar">
          <div class="grupo_form">
            <label for="nome_caixinha">Nome da Caixinha</label>
            <input type="text" id="nome_caixinha" name="nome_caixinha" placeholder="Ex: Retiro de Jovens" required>
          </div>
          <div class="grupo_form">
            <label for="meta_caixinha">Valor da Meta</label>
            <input type="number" id="meta_caixinha" name="meta_caixinha" placeholder="R$ 5000,00" step="0.01" required>
          </div>

    <div class="acoes_modal">
    <button type="button" class="btn btn_secundario" data-fechar-modal>X</button>
    <button type="submit" class="btn btn_primario">Criar Caixinha</button>
  </div>


        </form>
      </div>
    
    </div>

  <div class="modal" id="modal_contribuir">
      <div class="topo_modal">
          <h2>Fazer Contribuição</h2>
          <button class="fechar_modal" data-fechar-modal>&times;</button>
      </div>
      <div class="corpo_modal">
          <p class="texto_modal">
              Você está contribuindo para a caixinha: <strong id="nome_caixinha_contribuir"></strong>
          </p>

          <form action="/SheepHub/rotas/acoes_caixinha/contribuir.php" method="post">
      <input type="hidden" name="id_caixinha" id="id_caixinha_contribuir" value="">

              <div class="grupo_form">
                  <label for="valor_contribuir">Valor da Contribuição</label>
                  <input type="number" name="valor_contribuir" id="valor_contribuir" placeholder="R$ 50,00" step="0.01" required>
              </div>

              <div class="acoes_modal">
                  <button type="button" class="btn btn_secundario" data-fechar-modal>X</button>
                  <button type="submit" class="btn btn_primario  btn_contribuir">Confirmar Contribuição</button>
              </div>
          </form>
      </div>
  </div>



        <div class="modal" id="modal_retirar">
          <div class="topo_modal">
            <h2>Fazer Retirada</h2>
          </div>
          <div class="corpo_modal">
            <p class="texto_modal">Você está retirando da caixinha: <strong id="nome_caixinha_retirar"></strong></p>

                <form action="/SheepHub/rotas/acoes_caixinha/sacar.php" method="post">
                <input type="hidden" name="id_caixinha" id="id_caixinha_retirar">


              <div class="grupo_form">
                <label for="valor_retirar">Valor da Retirada</label>
                <input type="number" name="valor_retirar" id="valor_retirar" placeholder="R$ 100,00" required>
              </div>
              <div class="grupo_form">
                <label for="motivo_retirar">Motivo da Retirada</label>
                <textarea name="motivo_retirar" id="motivo_retirar" rows="3" placeholder="Ex: Compra de materiais para o evento" required></textarea>
              </div>

                <div class="acoes_modal">
        <button class="btn btn_secundario " data-fechar-modal type="button">X</button>
            <button class="btn btn_primario btn_retirar" type="submit">Confirmar Retirada</button>
          </div>
            </form>
          </div>
        
        </div>

  </body>
  </html>
