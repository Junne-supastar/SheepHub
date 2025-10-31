document.addEventListener('DOMContentLoaded', () => {
    const postImage = document.getElementById('post-image');
    const containerModal = document.getElementById('modal-container');
    const conteudoModal = document.getElementById('modal-content');
    
    // Esta linha agora vai encontrar o "X" DENTRO do modal
    const botaoFecharModal = document.getElementById('btn-fechar-modal'); 

    // Ícones de ação
    const iconeCurtirPost = document.querySelector('#cartao-postagem .icone-curtir');
    const iconeCurtirModal = document.querySelector('.modal-rodape .icone-curtir-modal');
    const iconeComentarModal = document.querySelector('.modal-rodape .icone-comentar-modal');

    // Função para abrir o modal
    const abrirModal = () => {
        containerModal.classList.remove('oculto');
    };

    // Função para fechar o modal
    const fecharModal = () => {
        containerModal.classList.add('oculto');
    };

    // Abrir modal ao clicar na IMAGEM da postagem
    if (postImage) {
        postImage.addEventListener('click', abrirModal);
    }

    // Fechar modal ao clicar no botão 'X' (agora o "X" correto)
    if (botaoFecharModal) {
        botaoFecharModal.addEventListener('click', fecharModal);
    }

    /* ==========================================================
      O CÓDIGO DE "CLICAR FORA" FOI REMOVIDO DAQUI
      ========================================================== 
    */

    // Impede que o clique no conteúdo do modal feche-o (este pode ficar)
    if (conteudoModal) {
        conteudoModal.addEventListener('click', (event) => {
            event.stopPropagation();
        });
    }
    
    // Funcionalidade de alternar a classe 'ativo' para os ícones de ação
    const toggleActiveClass = (element) => {
        if (element) {
            element.addEventListener('click', () => {
                element.classList.toggle('ativo');
            });
        }
    };

    toggleActiveClass(iconeCurtirPost);
    toggleActiveClass(iconeCurtirModal);
    toggleActiveClass(iconeComentarModal);
});