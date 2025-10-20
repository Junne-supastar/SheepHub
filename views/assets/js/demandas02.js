document.addEventListener('DOMContentLoaded', () => {

    // --- Seletores do DOM ---
    const verMaisButtons = document.querySelectorAll('.ver-mais-btn');
    const modalOverlay = document.getElementById('modalOverlay');
    const closeModalButtons = document.querySelectorAll('.close-modal, .btn-reject, .btn-accept');
    
    // Seleciona as partes do fundo que precisam do blur
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    // --- Seletores dos elementos DENTRO do modal ---
    // Precisamos deles para atualizar o conteúdo
    const modalAvatar = document.getElementById('modalAvatar');
    const modalName = document.getElementById('modalName');
    const modalInfo = document.getElementById('modalInfo');
    const modalBody = document.getElementById('modalBody');


    // --- Funções ---

    /**
     * Abre o modal e aplica o efeito de blur no fundo.
     */
    function openModal() {
        if (modalOverlay) {
            modalOverlay.classList.add('active');
        }
        if (sidebar && mainContent) {
            sidebar.classList.add('blurred');
            mainContent.classList.add('blurred');
        }
    }

    /**
     * Fecha o modal e remove o efeito de blur do fundo.
     */
    function closeModal() {
        if (modalOverlay) {
            modalOverlay.classList.remove('active');
        }
        if (sidebar && mainContent) {
            sidebar.classList.remove('blurred');
            mainContent.classList.remove('blurred');
        }
    }

    // --- Event Listeners ---

    // Adiciona listener para todos os botões "Ver mais"
    verMaisButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            // 1. Achar o card "pai" do botão que foi clicado
            const card = event.target.closest('.member-card');
            
            // 2. Pegar os dados guardados nos atributos 'data-*' do card
            const name = card.dataset.name;
            const img = card.dataset.img;
            const date = card.dataset.date;
            const description = card.dataset.description;

            // 3. Atualizar o conteúdo do modal com os dados do card
            if (modalAvatar) modalAvatar.src = img;
            if (modalAvatar) modalAvatar.alt = "Foto de " + name;
            if (modalName) modalName.textContent = name;
            if (modalInfo) modalInfo.textContent = date;
            if (modalBody) modalBody.textContent = description;

            // 4. Finalmente, abrir o modal
            openModal();
        });
    });

    // Adiciona listener para todos os elementos que fecham o modal
    closeModalButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });

    // Fecha o modal se o usuário clicar fora da caixa de conteúdo (no overlay)
    modalOverlay.addEventListener('click', (event) => {
        // Verifica se o clique foi no overlay e não no conteúdo do modal
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

});