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


