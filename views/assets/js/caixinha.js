  // caixinha.js 
  document.addEventListener('DOMContentLoaded', () => {

      // Overlay (fundo do modal)
      const fundoModal = document.querySelector('.fundo_modal') ||
                        document.querySelector('.modal-overlay') ||
                        document.querySelector('.fundo-modal');
    
      // Botão/área para abrir o modal de criar (cartao add)
      const btnAbrirCriar = document.querySelector('.cartao_add') ||
                            document.querySelector('.card-add') ||
                            document.querySelector('.cartao-add');
    
      // Todos os modais
      const modais = Array.from(document.querySelectorAll('.modal'));
    
      // Identifica os modais por id se existir
      const modalContribuir = document.getElementById('modal_contribuir')
                            || document.getElementById('modal-contribuir')
                            || modais.find(m => (m.id || '').toLowerCase().includes('contrib'))
                            || modais[1] || null;
    
      const modalRetirar = document.getElementById('modal_retirar')
                        || document.getElementById('modal-retirar')
                        || modais.find(m => (m.id || '').toLowerCase().includes('retir'))
                        || modais[2] || null;
    
      // Modal criar
      const modalCriar = document.getElementById('modal_criar')
                      || document.getElementById('modal-criar')
                      || modais.find(m => !m.id) // primeiro sem id
                      || modais[0] || null;
    
      const nomeCaixinhaContribuir = document.getElementById('nome_caixinha_contribuir')
                                  || document.getElementById('nome-caixinha-contribuir')
                                  || document.getElementById('contribuir-caixinha-nome')
                                  || document.querySelector('#contribuir-caixinha-nome')
                                  || null;
    
      const nomeCaixinhaRetirar = document.getElementById('nome_caixinha_retirar')
                                || document.getElementById('nome-caixinha-retirar')
                                || document.getElementById('retirar-caixinha-nome')
                                || document.querySelector('#retirar-caixinha-nome')
                                || null;
    
      // Botões que fecham (aceita data-fechar-modal ou data-close-modal)
      const btnsFechar = Array.from(document.querySelectorAll('[data-fechar-modal], [data-close-modal]'));
    
      // Funções de abrir/fechar
      const abrirModal = (modal) => {
        if (!modal || !fundoModal) return;
        modal.classList.add('ativo');
        fundoModal.classList.add('ativo');
      };
    
      const fecharModal = () => {
        const ativo = document.querySelector('.modal.ativo');
        if (!ativo || !fundoModal) return;
        ativo.classList.remove('ativo');
        fundoModal.classList.remove('ativo');
      };
    
      // Abrir modal de criar
      if (btnAbrirCriar && modalCriar) {
        btnAbrirCriar.addEventListener('click', () => abrirModal(modalCriar));
      }
    
      const cartoes = Array.from(document.querySelectorAll('.cartao, .card'));
      cartoes.forEach(cartao => {
        const botaoContribuir = cartao.querySelector('.btn_primario, .btn--primary, .btn-primary');
        const botaoRetirar    = cartao.querySelector('.btn_secundario, .btn--secondary, .btn-secondary');
    
        if (botaoContribuir) {
          botaoContribuir.addEventListener('click', (e) => {
            const tituloEl = cartao.querySelector('.titulo_cartao, .card__title, .titulo-cartao');
            const nome = tituloEl ? tituloEl.textContent.trim() : '';
            if (nomeCaixinhaContribuir) nomeCaixinhaContribuir.textContent = nome;

                // Pegando o ID da caixinha do botão/data-attribute
      const idCaixinha = cartao.getAttribute('data-id') || cartao.dataset.id;
      const inputId = document.getElementById('id_caixinha_contribuir');
      if (inputId && idCaixinha) inputId.value = idCaixinha;
      
            if (modalContribuir) abrirModal(modalContribuir);
          });
        }
    
        if (botaoRetirar) {
          botaoRetirar.addEventListener('click', (e) => {
            const tituloEl = cartao.querySelector('.titulo_cartao, .card__title, .titulo-cartao');
            const nome = tituloEl ? tituloEl.textContent.trim() : '';
            if (nomeCaixinhaRetirar) nomeCaixinhaRetirar.textContent = nome;

          // Pegar o ID da caixinha
          const idCaixinha = cartao.getAttribute('data-id') || cartao.dataset.id;
          const inputId = document.getElementById('id_caixinha_retirar');
          if (inputId && idCaixinha) inputId.value = idCaixinha;

            if (modalRetirar) abrirModal(modalRetirar);
          });
        }
      });
    
      // fechar via botão
      btnsFechar.forEach(b => b.addEventListener('click', fecharModal));
    
      if (fundoModal) {
        fundoModal.addEventListener('click', (e) => {
          if (e.target === fundoModal) fecharModal();
        });
      }
    
      // fechar com ESC
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') fecharModal();
      });
    

      if (!fundoModal) console.warn('Overlay do modal não encontrado (classe .fundo_modal).');
      if (!modalCriar) console.warn('Modal de criar não encontrado (esperado: primeiro .modal sem id).');
      if (!modalContribuir) console.warn('Modal de contribuir não encontrado (procure por id="modal_contribuir").');
      if (!modalRetirar) console.warn('Modal de retirar não encontrado (procure por id="modal_retirar").');
    
    });
    