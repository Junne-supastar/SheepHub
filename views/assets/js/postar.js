  const botaoPostar = document.querySelector(".botao-postar");
  const modalPost = document.getElementById("modal-post");
  const modalAjustar = document.getElementById("modal-ajustar");
  const botaoFechar = document.getElementById("fechar-modal");
  const botaoArquivo = document.getElementById("botao-arquivo");
  const inputImagem = document.getElementById("input-imagem");
  const previewAjustar = document.getElementById("preview-ajustar");
  const voltarModal = document.getElementById("voltar-modal");

  // abrir modal 1
  botaoPostar.addEventListener("click", () => {
    modalPost.classList.add("ativo");
  });

  // fechar modal 1
  botaoFechar.addEventListener("click", () => {
    modalPost.classList.remove("ativo");
  });

  // clicar fora fecha modal
  [modalPost, modalAjustar].forEach(m => {
    m.addEventListener("click", e => {
      if (e.target === m) m.classList.remove("ativo");
    });
  });

  // abrir seletor de arquivos
  botaoArquivo.addEventListener("click", () => {
    inputImagem.click();
  });

  // mostrar imagem no modal 2
  inputImagem.addEventListener("change", e => {
    const arquivo = e.target.files[0];
    if (arquivo) {
      const leitor = new FileReader();
      leitor.onload = (ev) => {
        previewAjustar.src = ev.target.result;
        modalPost.classList.remove("ativo");
        modalAjustar.classList.add("ativo");
      };
      leitor.readAsDataURL(arquivo);
    }
  });

  // voltar ao modal anterior
  voltarModal.addEventListener("click", () => {
    modalAjustar.classList.remove("ativo");
    modalPost.classList.add("ativo");
  });

  // tecla ESC fecha ambos
  document.addEventListener("keydown", e => {
    if (e.key === "Escape") {
      modalPost.classList.remove("ativo");
      modalAjustar.classList.remove("ativo");
    }
  });
