// Tabs
const tabs = document.querySelectorAll('.tab-link');
const contents = document.querySelectorAll('.tab-content');
const underline = document.querySelector('.underline');

function moveUnderline(tab) {
    underline.style.width = `${tab.offsetWidth}px`;
    underline.style.left = `${tab.offsetLeft}px`;
}

moveUnderline(document.querySelector('.tab-link.active'));

tabs.forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => c.style.display = 'none');
        this.classList.add('active');
        const contentId = this.getAttribute('data-tab');
        document.getElementById(contentId).style.display = 'block';
        moveUnderline(this);
    });
});

// Lógica para os botões de favoritar
function adicionarListenersFavoritar() {
    const botoesFavoritar = document.querySelectorAll('.botao-favoritar');
    botoesFavoritar.forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.toggle('favoritado');
            if (btn.classList.contains('favoritado')) {
                btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor" style="color: #facc15;"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" /></svg>`;
            } else {
                btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>`;
            }
        });
    });
}


