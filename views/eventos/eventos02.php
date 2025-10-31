<?php
session_start();

// Verifica se o usuário está logado e se tem nível 2

$usuario_nome  = $_SESSION['nome'] ?? 'Visitante';
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Eventos</title>
    <link rel="stylesheet" href="../assets/css/eventos02.css">
    <script src="../assets/js/eventos02.js" defer></script>
</head>
<body>
<?php include '../includes/sidebar.php'; ?>
   
<div class="container-eventos">
            <header class="secao-cabecalho">

                <nav class="navegacao">
                    <div class="aba-ativa-slider"></div>
            
                    <button class="botao-aba ativo" data-aba="todos">Todos</button>
                    <button class="botao-aba" data-aba="proximos">Eventos próximos</button>
                </nav>
            </header>

            <main id="grade-eventos" class="grade-eventos">

                <a href="#">
                    <div class="card" data-tipo-evento="proximo">
                        <div class="card__imagem-container">
                            <img src="https://images.pexels.com/photos/939702/pexels-photo-939702.jpeg" alt="" class="card__imagem">
                        </div>
                        <div class="card__conteudo">
                            <div class="card__conteudo-principal">
                                <p class="card__data">10/07 - 19h</p>
                                <h3 class="card__titulo">Retiro de Jovens</h3>
                                <p class="card__descricao" >Se inscreva para o Retiro de Jovens da Primeira Igreja Batista em Madureira!</p>
                            </div>
                            <div class="card__rodape">
                                <div class="organizador">
                                    <img class="organizador__imagem" src="https://placehold.co/40x40/e2e8f0/64748b?text=P" alt="Logo de PIB Madureira">
                                    <div>
                                        <p class="organizador__nome">PIB Madureira</p>
                                        <p class="organizador__data-postagem">18 de Agosto</p>
                                    </div>
                                </div>
                                <button class="botao-favoritar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#">
                    <div class="card" data-tipo-evento="proximo">
                        <div class="card__imagem-container">
                           <img src="https://images.pexels.com/photos/26743790/pexels-photo-26743790.jpeg" alt="" class="card__imagem">
                            <div class="card__imagem-sombra"></div>
                        </div>
                        <div class="card__conteudo">
                            <div class="card__conteudo-principal">
                                <p class="card__data">15/07 - 09h</p>
                                <h3 class="card__titulo">Conferência Missionária</h3>
                                <p class="card__descricao">Participe da nossa conferência anual de missões e seja inspirado por testemunhos.</p>
                            </div>
                            <div class="card__rodape">
                                <div class="organizador">
                                    <img class="organizador__imagem" src="https://placehold.co/40x40/dbeafe/1e40af?text=I" alt="Logo de Igreja Presbiteriana">
                                    <div>
                                        <p class="organizador__nome">Igreja Presbiteriana</p>
                                        <p class="organizador__data-postagem">22 de Agosto</p>
                                    </div>
                                </div>
                                <button class="botao-favoritar">
                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="#">
                    <div class="card" data-tipo-evento="passado">
                        <div class="card__imagem-container">
                           <img src="https://images.pexels.com/photos/2609954/pexels-photo-2609954.jpeg" alt="" class="card__imagem">
                            <div class="card__imagem-sombra"></div>
                        </div>
                        <div class="card__conteudo">
                            <div class="card__conteudo-principal">
                                <p class="card__data">22/07 - 18h</p>
                                <h3 class="card__titulo">Acampamento de Casais</h3>
                                <p class="card__descricao">Um final de semana para fortalecer laços e criar memórias inesquecíveis.</p>
                            </div>
                            <div class="card__rodape">
                                <div class="organizador">
                                    <img class="organizador__imagem" src="https://placehold.co/40x40/fee2e2/991b1b?text=C" alt="Logo de Comunidade da Graça">
                                    <div>
                                        <p class="organizador__nome">Comunidade da Graça</p>
                                        <p class="organizador__data-postagem">25 de Agosto</p>
                                    </div>
                                </div>
                                <button class="botao-favoritar">
                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#">
                    <div class="card" data-tipo-evento="passado">
                        <div class="card__imagem-container">
                            <img src="https://images.pexels.com/photos/939702/pexels-photo-939702.jpeg" alt="" class="card__imagem">
                            <div class="card__imagem-sombra"></div>
                        </div>
                        <div class="card__conteudo">
                            <div class="card__conteudo-principal">
                                <p class="card__data">10/07 - 19h</p>
                                <h3 class="card__titulo">Retiro de Jovens</h3>
                                <p class="card__descricao" >Se inscreva para o Retiro de Jovens da Primeira Igreja Batista em Madureira!</p>
                            </div>
                            <div class="card__rodape">
                                <div class="organizador">
                                    <img class="organizador__imagem" src="https://placehold.co/40x40/e2e8f0/64748b?text=P" alt="Logo de PIB Madureira">
                                    <div>
                                        <p class="organizador__nome">PIB Madureira</p>
                                        <p class="organizador__data-postagem">18 de Agosto</p>
                                    </div>
                                </div>
                                <button class="botao-favoritar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#">
                    <div class="card" data-tipo-evento="passado">
                        <div class="card__imagem-container">
                           <img src="https://images.pexels.com/photos/26743790/pexels-photo-26743790.jpeg" alt="" class="card__imagem">
                            <div class="card__imagem-sombra"></div>
                        </div>
                        <div class="card__conteudo">
                            <div class="card__conteudo-principal">
                                <p class="card__data">15/07 - 09h</p>
                                <h3 class="card__titulo">Conferência Missionária</h3>
                                <p class="card__descricao">Participe da nossa conferência anual de missões e seja inspirado por testemunhos.</p>
                            </div>
                            <div class="card__rodape">
                                <div class="organizador">
                                    <img class="organizador__imagem" src="https://placehold.co/40x40/dbeafe/1e40af?text=I" alt="Logo de Igreja Presbiteriana">
                                    <div>
                                        <p class="organizador__nome">Igreja Presbiteriana</p>
                                        <p class="organizador__data-postagem">22 de Agosto</p>
                                    </div>
                                </div>
                                <button class="botao-favoritar">
                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="#">
                    <div class="card" data-tipo-evento="passado">
                        <div class="card__imagem-container">
                           <img src="https://images.pexels.com/photos/2609954/pexels-photo-2609954.jpeg" alt="" class="card__imagem">
                            <div class="card__imagem-sombra"></div>
                        </div>
                        <div class="card__conteudo">
                            <div class="card__conteudo-principal">
                                <p class="card__data">22/07 - 18h</p>
                                <h3 class="card__titulo">Acampamento de Casais</h3>
                                <p class="card__descricao">Um final de semana para fortalecer laços e criar memórias inesquecíveis.</p>
                            </div>
                            <div class="card__rodape">
                                <div class="organizador">
                                    <img class="organizador__imagem" src="https://placehold.co/40x40/fee2e2/991b1b?text=C" alt="Logo de Comunidade da Graça">
                                    <div>
                                        <p class="organizador__nome">Comunidade da Graça</p>
                                        <p class="organizador__data-postagem">25 de Agosto</p>
                                    </div>
                                </div>
                                <button class="botao-favoritar">
                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>

                </main>

            <div id="mensagem-sem-eventos" class="mensagem-sem-eventos escondido">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3>Nenhum evento futuro</h3>
                <p>Volte em breve para verificar novas atualizações.</p>
            </div>
        </div>
    </div>
</body>
</html>