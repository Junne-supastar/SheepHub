<<<<<<< HEAD
// Seleciona todos os inputs de ícone
const radios = document.querySelectorAll('input[name="icone"]');
// Seleciona o ícone principal (o de "+")
const iconePrincipal = document.querySelector('.bxs-plus');

radios.forEach(radio => {
  radio.addEventListener('change', () => {
    // Pega o <i> dentro do label correspondente
    const iconeEscolhido = radio.nextElementSibling.querySelector('i').className;

    // Substitui o ícone principal pelo novo
    iconePrincipal.className = iconeEscolhido;
  });
});

const objetivoInput = document.getElementById('objetivo');
const investimentoInput = document.getElementById('investimento');

// cadastroMeta.js

function formatarMoeda(input) {
    let valor = input.value;

    // Remove tudo que não é número
    valor = valor.replace(/\D/g, '');

    // Transforma em número inteiro
    valor = (parseInt(valor) || 0).toString();

    // Adiciona zeros à esquerda para garantir pelo menos 3 dígitos (para centavos)
    while (valor.length < 3) {
        valor = '0' + valor;
    }

    // Pega os centavos (últimos 2 dígitos)
    let centavos = valor.slice(-2);
    let inteiros = valor.slice(0, -2);

    // Adiciona pontos de milhar
    inteiros = inteiros.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    input.value = inteiros + ',' + centavos;
}


// Aplica a máscara ao digitar
objetivoInput.addEventListener('input', () => formatarMoeda(objetivoInput));
investimentoInput.addEventListener('input', () => formatarMoeda(investimentoInput));


function parseValor(str) {
  return parseFloat(str.replace(/[R$\s.]/g, '').replace(',', '.')) || 0;
}

// ====== ATUALIZA E VALIDA ======
function atualizarValores(e) {
  const input = e.target;
  const cursor = input.selectionStart;
  const valorNumerico = parseValor(input.value);
  input.value = formatarMoeda(valorNumerico.toFixed(2).replace('.', ''));
  
  const objetivo = parseValor(objetivoInput.value);
  const investimento = parseValor(investimentoInput.value);

  if (objetivo < investimento && objetivo > 0) {
    objetivoInput.setCustomValidity(
      `O valor da meta deve ser maior ou igual ao investimento (R$ ${investimento.toFixed(2).replace('.', ',')})`
    );
  } else {
    objetivoInput.setCustomValidity('');
  }

  // Restaura o cursor pro final (pra não travar o input)
  input.setSelectionRange(input.value.length, input.value.length);
}

objetivoInput.addEventListener('input', atualizarValores);
investimentoInput.addEventListener('input', atualizarValores);
=======
// Seleciona todos os inputs de ícone
const radios = document.querySelectorAll('input[name="icone"]');
// Seleciona o ícone principal (o de "+")
const iconePrincipal = document.querySelector('.bxs-plus');

radios.forEach(radio => {
  radio.addEventListener('change', () => {
    // Pega o <i> dentro do label correspondente
    const iconeEscolhido = radio.nextElementSibling.querySelector('i').className;

    // Substitui o ícone principal pelo novo
    iconePrincipal.className = iconeEscolhido;
  });
});


>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
