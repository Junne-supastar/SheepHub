
const gradeEventos = document.getElementById('grade-eventos');
const mensagemSemEventos = document.getElementById('mensagem-sem-eventos');
const botoesAba = document.querySelectorAll('.botao-aba');
const todosOsCards = document.querySelectorAll('.card');


const slider = document.querySelector('.aba-ativa-slider');

// Função para mover o slider para a aba ativa
const moverSlider = () => {
    const abaAtiva = document.querySelector('.botao-aba.ativo');
    if (abaAtiva) {
        slider.style.width = `${abaAtiva.offsetWidth}px`;
        slider.style.transform = `translateX(${abaAtiva.offsetLeft}px)`;
    }
};


// Lógica das abas de navegação
botoesAba.forEach(botao => {
    botao.addEventListener('click', () => {
        botoesAba.forEach(btn => btn.classList.remove('ativo'));
        botao.classList.add('ativo');

        const aba = botao.dataset.aba;
        renderizarEventos(aba);
        moverSlider();
    });
});


// Função para filtrar e exibir os eventos na tela
const renderizarEventos = (filtro = 'todos') => {
    let eventosVisiveis = 0;

    todosOsCards.forEach(card => {
        const tipoEvento = card.dataset.tipoEvento;
        const mostrarCard = filtro === 'todos' || tipoEvento === 'proximo';

        card.classList.toggle('escondido', !mostrarCard);

        if (mostrarCard) {
            eventosVisiveis++;
        }
    });

    const semEventosParaMostrar = eventosVisiveis === 0;
    gradeEventos.classList.toggle('escondido', semEventosParaMostrar);
    mensagemSemEventos.classList.toggle('escondido', !semEventosParaMostrar);
};

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


// Renderização inicial e adição de listeners
renderizarEventos('todos');
adicionarListenersFavoritar();

document.addEventListener('DOMContentLoaded', moverSlider);
window.addEventListener('resize', moverSlider);