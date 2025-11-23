const entradas = {
    numero: document.getElementById('numeroCartao'),
    nome: document.getElementById('nomeCartao'),
    validade: document.getElementById('validadeCartao'),
    cvv: document.getElementById('cvvCartao')
};

const mostradores = {
    numero: document.getElementById('mostradorNumero'),
    nome: document.getElementById('mostradorNome'),
    validade: document.getElementById('mostradorValidade'),
    cvv: document.getElementById('mostradorCvv'),
    marca: document.getElementById('iconeMarcaCartao')
};

const cartaoInterno = document.getElementById('cartaoInterno');
const formulario = document.getElementById('formularioPagamento');

// --- Lógica de Interatividade ---

entradas.numero.addEventListener('input', (evento) => {
    let valor = evento.target.value.replace(/\D/g, '');
    
    if (valor.startsWith('4')) {
        mostradores.marca.innerHTML = '<i class="fa-brands fa-cc-visa"></i>';
    } else if (valor.startsWith('5')) {
        mostradores.marca.innerHTML = '<i class="fa-brands fa-cc-mastercard"></i>';
    } else {
        mostradores.marca.innerHTML = '<i class="fa-solid fa-credit-card"></i>';
    }

    valor = valor.replace(/(.{4})/g, '$1 ').trim();
    evento.target.value = valor;

    mostradores.numero.textContent = valor || '#### #### #### ####';
});

// 2. Nome do Titular
entradas.nome.addEventListener('input', (evento) => {
    mostradores.nome.textContent = evento.target.value || 'NOME DO TITULAR';
});

// 3. Validade (Máscara MM/AA)
entradas.validade.addEventListener('input', (evento) => {
    let valor = evento.target.value.replace(/\D/g, '');
    if (valor.length >= 2) {
        valor = valor.substring(0,2) + '/' + valor.substring(2,4);
    }
    evento.target.value = valor;
    mostradores.validade.textContent = valor || 'MM/AA';
});

// 4. CVV (Efeito de virar - Flip)
entradas.cvv.addEventListener('focus', () => {
    cartaoInterno.classList.add('virado');
});

entradas.cvv.addEventListener('blur', () => {
    cartaoInterno.classList.remove('virado');
});

entradas.cvv.addEventListener('input', (evento) => {
    let valor = evento.target.value.replace(/\D/g, '');
    evento.target.value = valor;
    mostradores.cvv.textContent = '*'.repeat(valor.length);
});

// --- Processamento do Formulário ---
formulario.addEventListener('submit', (evento) => {
    evento.preventDefault();
    processarPagamento();
});

function processarPagamento() {
    const botao = document.querySelector('.btn-pagar');
    const textoOriginal = botao.innerHTML;
    
    // Estado de carregamento
    botao.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Processando...';
    botao.disabled = true;
    botao.style.opacity = '0.7';

    setTimeout(() => {
        botao.innerHTML = textoOriginal;
        botao.disabled = false;
        botao.style.opacity = '1';

        const modal = document.getElementById('modalSucesso');
        modal.classList.add('visivel');

        formulario.reset();
        mostradores.numero.textContent = '#### #### #### ####';
        mostradores.nome.textContent = 'NOME DO TITULAR';
        mostradores.validade.textContent = 'MM/AA';
        
    }, 2000);
}

// Adicione isso ao seu objeto de entradas ou crie um novo const
const btnFecharModal = document.getElementById('btnFecharModal');

// Adicione o ouvinte de evento
if(btnFecharModal) {
    btnFecharModal.addEventListener('click', fecharModal);
}

function fecharModal() {
    const modal = document.getElementById('modalSucesso');
    modal.classList.remove('visivel');
}