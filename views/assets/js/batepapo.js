 // --- DADOS MOCK ---
 const dadosChat = {
    usuarios: [
        { id: 1, nome: 'Ana Silva', avatar: 'https://placehold.co/40x40/BFDBFE/1E40AF?text=A', ultimaMensagem: 'Ok, combinado! Te vejo lá.', hora: '16:10', naoLidas: 2 },
        { id: 2, nome: 'Bruno Costa', avatar: 'https://placehold.co/40x40/A7F3D0/047857?text=B', ultimaMensagem: 'Você viu o email que mandei?', hora: '15:45', naoLidas: 0 },
        { id: 3, nome: 'Carla Dias', avatar: 'https://placehold.co/40x40/FDE68A/92400E?text=C', ultimaMensagem: 'Reunião de equipe amanhã às 9h.', hora: 'Ontem', naoLidas: 0 },
        { id: 4, nome: 'Daniel Alves', avatar: 'https://placehold.co/40x40/DDD6FE/5B21B6?text=D', ultimaMensagem: 'Obrigado pela ajuda no projeto!', hora: '24/06', naoLidas: 0 },
    ],
    mensagens: {
        1: [{ de: 'outro', texto: 'Oi! Tudo bem? Conseguiu ver aquele relatório que te enviei?', hora: '16:05' }, { de: 'eu', texto: 'Oi Ana! Vi sim, já estou analisando. Te dou um retorno em breve.', hora: '16:08' }, { de: 'outro', texto: 'Ok, combinado! Te vejo lá.', hora: '16:10' },],
        2: [{ de: 'outro', texto: 'E aí, tudo certo?', hora: '15:40' }, { de: 'outro', texto: 'Você viu o email que mandei?', hora: '15:45' },],
        3: [{ de: 'outro', texto: 'Olá, bom dia. Só para lembrar: Reunião de equipe amanhã às 9h.', hora: 'Ontem' },],
        4: [{ de: 'eu', texto: 'Daniel, o acesso foi liberado.', hora: '23/06' }, { de: 'outro', texto: 'Obrigado pela ajuda no projeto!', hora: '24/06' },]
    }
};
let idUsuarioAtivo = null;

// --- ELEMENTOS DO DOM ---
const listaContatosEl = document.getElementById('lista-contatos');
const chatCabecalhoEl = document.getElementById('chat-cabecalho');
const areaMensagensEl = document.getElementById('area-mensagens');
const containerInputMensagemEl = document.getElementById('container-input-mensagem');
const inputBuscaEl = document.getElementById('input-busca');
// Variáveis da Navbar foram removidas

// --- LÓGICA DO CHAT ---

function renderizarJanelaChat(idUsuario) {
    const usuario = dadosChat.usuarios.find(u => u.id === idUsuario);
    
    // Se nenhum usuário for encontrado (ou nenhum selecionado)
    if (!usuario) {
        chatCabecalhoEl.innerHTML = '';
        areaMensagensEl.innerHTML = `
            <div class="area-mensagens-vazia">
                <div class="conteudo-vazio">
                    <h2>Selecione uma conversa</h2>
                    <p>Escolha alguém da lista ao lado para começar.</p>
                </div>
            </div>`;
        containerInputMensagemEl.classList.add('escondido'); // Esconde o input
        return;
    }

    idUsuarioAtivo = idUsuario;
    containerInputMensagemEl.classList.remove('escondido'); // Mostra o input

    // Renderiza o cabeçalho do chat
    chatCabecalhoEl.innerHTML = `
        <div class="usuario-info">
            <img src="${usuario.avatar}" alt="Avatar ${usuario.nome}" class="avatar-pequeno">
            <span class="usuario-nome">${usuario.nome}</span>
        </div>
        <button class="botao-opcoes">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
        </button>
    `;

    // Renderiza as mensagens
    const mensagens = dadosChat.mensagens[idUsuario] || [];
    areaMensagensEl.innerHTML = mensagens.map(msg => `
        <div class="container-mensagem ${msg.de === 'eu' ? 'enviada' : 'recebida'}">
            <div class="bolha-mensagem">
                <p class="texto-mensagem">${msg.texto}</p>
                <p class="hora-mensagem">${msg.hora}</p>
            </div>
        </div>
    `).join('');

    // Rola para a última mensagem
    areaMensagensEl.scrollTop = areaMensagensEl.scrollHeight;
}

function renderizarListaContatos(usuariosParaRenderizar) {
    if (usuariosParaRenderizar.length === 0) {
        listaContatosEl.innerHTML = `<p style="padding: 1rem; text-align: center; color: #6b7280;">Nenhum usuário encontrado.</p>`;
        return;
    }

    listaContatosEl.innerHTML = usuariosParaRenderizar.map(usuario => `
        <div data-id="${usuario.id}" class="item-contato ${usuario.id === idUsuarioAtivo ? 'contato-ativo' : ''}">
            <img src="${usuario.avatar}" alt="Avatar ${usuario.nome}" class="avatar-pequeno">
            <div class="contato-info">
                <p class="contato-nome">${usuario.nome}</p>
                <p class="contato-mensagem">${usuario.ultimaMensagem}</p>
            </div>
            <div class="contato-meta">
                <span>${usuario.hora}</span>
                ${usuario.naoLidas > 0 ? `<span class="selo-nao-lido">${usuario.naoLidas}</span>` : ''}
            </div>
        </div>
    `).join('');
}

// --- EVENT LISTENERS (CHAT) ---
listaContatosEl.addEventListener('click', (e) => {
    const itemContato = e.target.closest('.item-contato');
    if (itemContato) {
        const idUsuario = parseInt(itemContato.dataset.id, 10);
        renderizarJanelaChat(idUsuario);
        
        // Re-renderiza a lista para atualizar o estado "ativo"
        const termoBusca = inputBuscaEl.value.toLowerCase();
        const usuariosFiltrados = dadosChat.usuarios.filter(user => user.nome.toLowerCase().includes(termoBusca));
        renderizarListaContatos(usuariosFiltrados);
    }
});

inputBuscaEl.addEventListener('input', (e) => {
    const termoBusca = e.target.value.toLowerCase();
    const usuariosFiltrados = dadosChat.usuarios.filter(user => user.nome.toLowerCase().includes(termoBusca));
    renderizarListaContatos(usuariosFiltrados);
});

// --- LÓGICA DA NAVBAR (REMOVIDA) ---

// --- INICIALIZAÇÃO ---
window.addEventListener('DOMContentLoaded', () => {
    renderizarListaContatos(dadosChat.usuarios);
    renderizarJanelaChat(1); // Deixa o primeiro chat ativo
});