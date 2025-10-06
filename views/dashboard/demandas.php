<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandas - SheepHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/demandas.css">

</head>
<body>
    <div class="container-principal">
        <?php include __DIR__ . '/../includes/sidebar.php'; ?>
            <main class="content">
                 <!-- Cabeçalho personalizado do dashboard -->
                <div class="cabecalho-dashboard">
                    <p class="bem-vindo">Bem vindo, Augustus!</p>
                    <h1 class="titulo-dashboard">Dashboard</h1>
                    <nav class="menu-dashboard">
                        <span class="item-menu" id="menu-dizimo">Dízimos e ofertas</span>
                        <span class="item-menu">Membros</span>
                        <span class="item-menu ativo" id="menu-demandas">Demandas
                            <span class="barra-aba"></span>
                        </span>
                    </nav>
                </div>
                <div class="grid-demandas">
                    <div class="card-demanda">
                         <img src="views/assets/img/efeito.png" alt="" class="efeito-nuvem-card">
                        <img src="views/assets/img/larissa.png" alt="Larissa Leal" class="avatar-demanda">
                        <div class="nome-demanda">Larissa Leal</div>
                        <button class="botao-vermais">Ver mais</button>
                    </div>
                    <div class="card-demanda">
                         <img src="views/assets/img/efeito.png" alt="" class="efeito-nuvem-card">
                        <img src="views/assets/img/gabriel.png" alt="Gabriel Pitz" class="avatar-demanda">
                        <div class="nome-demanda">Gabriel Pitz</div>
                        <button class="botao-vermais">Ver mais</button>
                    </div>
                    <div class="card-demanda">
                         <img src="views/assets/img/efeito.png" alt="" class="efeito-nuvem-card">
                        <img src="views/assets/img/julia.png" alt="Julia Ramos" class="avatar-demanda">
                        <div class="nome-demanda">Julia Ramos</div>
                        <button class="botao-vermais">Ver mais</button>
                    </div>
                    <div class="card-demanda">
                         <img src="views/assets/img/efeito.png" alt="" class="efeito-nuvem-card">
                        <img src="views/assets/img/juliana.png" alt="Juliana Silva" class="avatar-demanda">
                        <div class="nome-demanda">Juliana Silva</div>
                        <button class="botao-vermais">Ver mais</button>
                    </div>
                    <div class="card-demanda">
                         <img src="views/assets/img/efeito.png" alt="" class="efeito-nuvem-card">
                        <img src="views/assets/img/jose.png" alt="José Batista" class="avatar-demanda">
                        <div class="nome-demanda">José Batista</div>
                        <button class="botao-vermais">Ver mais</button>
                    </div>
                    <div class="card-demanda">
                         <img src="views/assets/img/efeito.png" alt="" class="efeito-nuvem-card">
                        <span class="alerta">!</span>
                        <img src="views/assets/img/bernardo.png" alt="Bernardo Cota" class="avatar-demanda">
                        <div class="nome-demanda">Bernardo Cota</div>
                        <button class="botao-vermais">Ver mais</button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal de Detalhes da Demanda -->
    <div id="modal-demanda" class="modal-demanda hidden">
        <div class="modal-conteudo">
            <button class="modal-fechar" id="fechar-modal">&times;</button>
            <div class="modal-header">
                <img src="views/assets/img/larissa.png" alt="Larissa Leal" class="modal-avatar">
                <span class="modal-nome">Larissa Leal</span>
            </div>
            <div class="modal-texto">
                Como vocês sabem, tenho servido como professora da Escola Dominical com muita alegria e dedicação nos últimos cinco anos. Amo trabalhar com as crianças e sinto que esse ministério é um chamado que Deus colocou em minha vida. Mas tenho me sentido sobrecarregada e gostaria de ajuda da liderança.
            </div>
        </div>
    </div>
    <div class="painel-demandas-lateral">
    <div class="resumo-demandas">
        <div class="linha-status">
            <span class="icone-alerta">!</span>
            <span class="texto-nao-lida"><strong>1</strong> demanda não lida</span>
        </div>
        <div class="linha-status">
            <span class="icone-vista">&#10003;</span>
            <span class="texto-vista"><strong>5</strong> demandas vistas</span>
        </div>
    </div>
    <div class="card-status-demandas">
        <h3>Status das demandas</h3>
        <div class="grafico-pizza">
            <!-- Exemplo de gráfico pizza (SVG simples) -->
            <svg width="90" height="90" viewBox="0 0 32 32">
                <circle r="16" cx="16" cy="16" fill="#C0CED6"/>
                <path d="M16 16 L16 0 A16 16 0 0 1 31.9 18 Z" fill="#80CDEB"/>
                <path d="M16 16 L31.9 18 A16 16 0 0 1 16 32 Z" fill="#7BAEC2"/>
            </svg>
            <ul class="legenda-grafico">
                <li><span class="cor-pendente"></span>Pendentes</li>
                <li><span class="cor-andamento"></span>Em andamento</li>
                <li><span class="cor-concluida"></span>Concluídas</li>
            </ul>
        </div>
    </div>
    <div class="card-demanda-lida">
        <div class="info-membro">
            <img src="views/assets/img/gabriel.png" alt="Gabriel Pitz">
            <div>
                <strong>Gabriel Pitz</strong>
                <span>28 anos | Grupo de Teatro</span>
            </div>
        </div>
        <div class="status-lida">
            <span class="icone-vista">&#10003;</span>
            <span>Lida</span>
        </div>
    </div>
</div>
    <script>
const demandas = [
    {
        nome: "Larissa Leal",
        img: "views/assets/img/larissa.png",
        texto: "Como vocês sabem, tenho servido como professora da Escola Dominical com muita alegria e dedicação nos últimos cinco anos. Amo trabalhar com as crianças e sinto que esse ministério é um chamado que Deus colocou em minha vida. Mas tenho me sentido sobrecarregada e gostaria de ajuda da liderança."
    },
    {
        nome: "Gabriel Pitz",
        img: "views/assets/img/gabriel.png",
        texto: "Preciso de apoio para organizar as atividades do grupo de jovens. Sinto que podemos fazer mais, mas estou sem ideias novas e gostaria de sugestões."
    },
    {
        nome: "Julia Ramos",
        img: "views/assets/img/julia.png",
        texto: "Estou passando por um momento difícil na família e gostaria de orações e, se possível, conversar com alguém da liderança."
    },
    {
        nome: "Juliana Silva",
        img: "views/assets/img/juliana.png",
        texto: "Gostaria de participar mais ativamente dos eventos da igreja, mas não sei por onde começar. Preciso de orientação."
    },
    {
        nome: "José Batista",
        img: "views/assets/img/jose.png",
        texto: "Estou com dificuldades para comparecer aos cultos devido ao trabalho. Gostaria de saber se há grupos de estudo em horários alternativos."
    },
    {
        nome: "Bernardo Cota",
        img: "views/assets/img/bernardo.png",
        texto: "Estou sentindo falta de integração entre os membros novos. Sugiro criarmos um grupo de acolhimento."
    }
];

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modal-demanda');
    const avatar = modal.querySelector('.modal-avatar');
    const nome = modal.querySelector('.modal-nome');
    const texto = modal.querySelector('.modal-texto');

    document.querySelectorAll('.botao-vermais').forEach(function(btn, idx) {
        btn.addEventListener('click', function() {
            avatar.src = demandas[idx].img;
            avatar.alt = demandas[idx].nome;
            nome.textContent = demandas[idx].nome;
            texto.textContent = demandas[idx].texto;
            modal.classList.remove('hidden');
        });
    });

    document.getElementById('fechar-modal').onclick = function() {
        modal.classList.add('hidden');
    };
    modal.addEventListener('click', function(e) {
        if(e.target === this) modal.classList.add('hidden');
    });
});

document.getElementById('menu-demandas').onclick = function() {
    window.location.href = 'demandas.html';
};

document.getElementById('menu-dizimo').onclick = function() {
    window.location.href = 'dashboard.html';
};
</script>
    <!-- filepath: c:\xampp\htdocs\SheepHub-main\demandas.html -->
</body>
</html>