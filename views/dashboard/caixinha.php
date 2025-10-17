<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Caixinha Igreja Church</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-a5xw+4LxU0YrKjW/s1nyzVSkPBgKfqWrGrzJ8e/v2O0zPNMgD6q+Z6x4R5k1M4X9Lmz8mG63N5iWPh4Fz+0M5Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <link rel="stylesheet" href="../assets/css/caixinha.css">
  <script src="../assets/js/caixinha.js" defer></script>
</head>
<body>

  <?php include __DIR__ . '/../includes/sidebar.php'; ?>

    <div class="area_eventos">
      <div class="container">
        <header class="cabecalho_pagina">
          <h1 class="titulo_pagina">Caixinha Igreja Church</h1>
          <p class="total_pagina">Total arrecadado: <strong>R$ 17.750,00</strong></p>
        </header>

        <main class="grade_cartao">

          <div class="cartao">

            <div class="topo_cartao">
              <h2 class="titulo_cartao">Retiro Fazenda</h2>
              <span class="info_cartao">Total: R$230,00</span>
            </div>

            <div class="meta_cartao">
              <span>Meta</span>
              <span>R$7.550,00</span>
            </div>

            <div class="barra_progresso">
              <div class="progresso" style="width: 30%;"></div>
            </div>

            <div class="acoes_cartao">
              <button class="btn btn_primario"><img src="../views/assets/img/coracao-caixinha.png" alt=""> Contribuir</button>
              <button class="btn btn_secundario"><img src="../views/assets/img/vetor-caixinha.png" alt=""></button>
            </div>

          </div>

          <div class="cartao">
            <div class="topo_cartao">
              <h2 class="titulo_cartao">Retiro Fazenda</h2>
              <span class="info_cartao">Total: R$230,00</span>
            </div>
            <div class="meta_cartao">
              <span>Meta</span>
              <span>R$7.550,00</span>
            </div>
            <div class="barra_progresso">
              <div class="progresso" style="width: 50%;"></div>
            </div>
            <div class="acoes_cartao">
              <button class="btn btn_primario"><img src="../views/assets/img/coracao-caixinha.png" alt=""> Contribuir</button>
              <button class="btn btn_secundario"><img src="../views/assets/img/vetor-caixinha.png" alt=""></button>
            </div>
          </div>

          <div class="cartao">
            <div class="topo_cartao">
              <h2 class="titulo_cartao">Retiro Fazenda</h2>
              <span class="info_cartao">Total: R$200,00 <span class="info_negativo">- 30,00</span></span>
            </div>
            <div class="meta_cartao">
              <span>Meta</span>
              <span>R$7.550,00</span>
            </div>
            <div class="barra_progresso">
              <div class="progresso" style="width: 20%;"></div>
            </div>
            <div class="acoes_cartao">
              <button class="btn btn_primario"><img src="../views/assets/img/coracao-caixinha.png" alt=""> Contribuir</button>
              <button class="btn btn_secundario"><img src="../views/assets/img/vetor-caixinha.png" alt=""></button>
            </div>
          </div>

          <div class="cartao">
            <div class="topo_cartao">
              <h2 class="titulo_cartao">Retiro Fazenda</h2>
              <span class="info_cartao">Total: R$230,00 <span class="info_negativo">- 30,00</span></span>
            </div>
            <div class="meta_cartao">
              <span>Meta</span>
              <span>R$7.550,00</span>
            </div>
            <div class="barra_progresso">
              <div class="progresso" style="width: 70%;"></div>
            </div>
            <div class="acoes_cartao">
              <button class="btn btn_primario"><img src="../views/assets/img/coracao-caixinha.png" alt=""> Contribuir</button>
              <button class="btn btn_secundario"><img src="../views/assets/img/vetor-caixinha.png" alt=""></button>
            </div>
          </div>

          <div class="cartao_add">
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
      <form action="#">
        <div class="grupo_form">
          <label for="nome_caixinha">Nome da Caixinha</label>
          <input type="text" id="nome_caixinha" placeholder="Ex: Retiro de Jovens">
        </div>
        <div class="grupo_form">
          <label for="meta_caixinha">Valor da Meta</label>
          <input type="number" id="meta_caixinha" placeholder="R$ 5000,00">
        </div>
      </form>
    </div>
    <div class="acoes_modal">
      <button class="btn btn_secundario" data-fechar-modal>X</button>
      <button class="btn btn_primario">Criar Caixinha</button>
    </div>
  </div>

  <div class="modal" id="modal_contribuir">
    <div class="topo_modal">
      <h2>Fazer Contribuição</h2>
      <button class="fechar_modal" data-fechar-modal>&times;</button>
    </div>
    <div class="corpo_modal">
      <p class="texto_modal">Você está contribuindo para a caixinha: <strong id="nome_caixinha_contribuir"></strong></p>
      <form action="#">
        <div class="grupo_form">
          <label for="valor_contribuir">Valor da Contribuição</label>
          <input type="number" id="valor_contribuir" placeholder="R$ 50,00">
        </div>
      </form>
    </div>
    <div class="acoes_modal">
      <button class="btn btn_secundario" data-fechar-modal>X</button>
      <button class="btn btn_primario">Confirmar Contribuição</button>
    </div>
  </div>

  <div class="modal" id="modal_retirar">
    <div class="topo_modal">
      <h2>Fazer Retirada</h2>
    </div>
    <div class="corpo_modal">
      <p class="texto_modal">Você está retirando da caixinha: <strong id="nome_caixinha_retirar"></strong></p>
      <form action="#">
        <div class="grupo_form">
          <label for="valor_retirar">Valor da Retirada</label>
          <input type="number" id="valor_retirar" placeholder="R$ 100,00">
        </div>
        <div class="grupo_form">
          <label for="motivo_retirar">Motivo da Retirada</label>
          <textarea id="motivo_retirar" rows="3" placeholder="Ex: Compra de materiais para o evento"></textarea>
        </div>
      </form>
    </div>
    <div class="acoes_modal">
      <button class="btn btn_secundario" data-fechar-modal>X</button>
      <button class="btn btn_primario">Confirmar Retirada</button>
    </div>
  </div>

</body>
</html>
