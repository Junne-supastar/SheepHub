document.addEventListener('DOMContentLoaded', () => {
  const acoesList = document.querySelectorAll('.acoes');

  acoesList.forEach(acoes => {
    const btn = acoes.querySelector('.menu-btn');
    const modal = acoes.querySelector('.menu-modal');

    if (btn && modal) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();

        // Fecha outros modais abertos
        document.querySelectorAll('.menu-modal').forEach(m => {
          if (m !== modal) m.style.display = 'none';
        });

        // Alterna o modal clicado
        modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
      });
    }
  });

  // Fecha todos os modais ao clicar fora
  document.addEventListener('click', () => {
    document.querySelectorAll('.menu-modal').forEach(m => m.style.display = 'none');
  });
});
