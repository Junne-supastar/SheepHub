<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../assets/css/feed04.css">
    <script src="../assets/js/feed04.js" defer></script>

<body>
<?php include __DIR__ . '/../includes/sidebar.php'; ?>

     <div class="container-principal">
        <div class="layout-feed">

            <div class="coluna-principal">

                <div class="cartao cartao-boasvindas">
                    <div class="cartao-boasvindas-conteudo">
                        <h2>Olá,  <?= htmlspecialchars($usuario_nome) ?>!</h2>
                        <p>Encontre novas conexões e fortaleça sua fé.</p>
                    </div>
                </div>

                <div id="cartao-postagem" class="cartao">
                    <div class="postagem-cabecalho">
                        <div class="info-usuario">
                            <img src="https://placehold.co/40x40/E2E8F0/333?text=CS" alt="Avatar Clara Silva" class="avatar">
                            <div class="detalhes-usuario">
                                <div class="nome"> <?= htmlspecialchars($usuario_nome) ?></div>
                                <div class="localizacao">Rio de Janeiro - Igreja Universal</div>
                            </div>
                        </div>
                        <svg class="icone-mais" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                    </div>
                    
                    <div class="postagem-imagem">
                        <img id="post-image" src="https://images.pexels.com/photos/2664483/pexels-photo-2664483.jpeg" alt="Interior da Igreja">
                    </div>

                    <div class="postagem-acoes">
                        <svg class="icone-acao icone-curtir" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>

            </div>

            <div class="coluna-lateral">

                <div class="cartao cartao-citacoes">
                    <div class="circulo-decorativo"></div>
                    
                    <div class="cartao-citacoes-conteudo">
                        <h3>Citações diárias</h3>
                        <p class="subtitulo">Todos os dias, uma nova citação</p>
                        
                        <p class="citacao">
                            "O Senhor é o meu pastor; nada me faltará"
                        </p>
                    </div>
                </div>

                <div class="cartao cartao-sugestoes">
                    <h3>Sugestões</h3>
                    <p class="subtitulo">Talvez você goste desses perfis</p>

                    <ul class="lista-sugestoes">
                        <li class="item-sugestao">
                            <div class="info-usuario">
                                <img src="https://placehold.co/40x40/E2E8F0/333?text=CS" alt="Avatar Clara Silva" class="avatar">
                                <span class="nome">Clara Silva</span>
                            </div>
                            <button class="btn-seguir">Seguir</button>
                        </li>
                        <li class="item-sugestao">
                            <div class="info-usuario">
                                <img src="https://placehold.co/40x40/E2E8F0/333?text=A" alt="Avatar Anderson" class="avatar">
                                <span class="nome">Anderson</span>
                            </div>
                            <button class="btn-seguir">Seguir</button>
                        </li>
                        <li class="item-sugestao">
                            <div class="info-usuario">
                                <img src="https://placehold.co/40x40/E2E8F0/333?text=M" alt="Avatar Marina" class="avatar">
                                <span class="nome">Marina</span>
                            </div>
                            <button class="btn-seguir">Seguir</button>
                        </li>
                        <li class="item-sugestao">
                            <div class="info-usuario">
                                <img src="https://placehold.co/40x40/E2E8F0/333?text=C" alt="Avatar Cristina" class="avatar">
                                <span class="nome">Cristina</span>
                            </div>
                            <button class="btn-seguir">Seguir</button>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div id="modal-container" class="modal-fundo oculto">

        
        <div id="modal-content" class="modal-conteudo">
            
            <button id="btn-fechar-modal">
                <svg class="icone-acao" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <div class="modal-imagem">
                <img src="https://placehold.co/800x900/F3F4F6/9CA3AF?text=Imagem+da+Igreja" alt="Interior da Igreja">
            </div>

            <div class="modal-detalhes">
                <div class="postagem-cabecalho" style="padding: 0;"> <div class="info-usuario">
                        <img src="https://placehold.co/40x40/E2E8F0/333?text=IC" alt="Avatar Igreja Church" class="avatar">
                        <div class="detalhes-usuario">
                            <div class="nome">Igreja Church</div>
                            <div class="identificador">@igreja_church</div>
                        </div>
                    </div>
                    
                </div>

                <div class="modal-postagem-texto">
                    <p>Lorem ipsum dolor sit amet consectetur. Lorem ipsum sit pretium commodo elementum. A ipsum id integer tellus ornare tempor. Irem et sit cras sed. Phasellus pretium suspendisse bibendum maecenas eleifend nisi.</p>
                </div>
                <div class="horario">4 min</div>

                <div class="secao-comentarios">
                    <div class="container-comentario">
                        <div class="comentario">
                            <img src="https://placehold.co/36x36/E2E8F0/333?text=C" alt="Avatar Cristina" class="avatar avatar-pequeno">
                            <div class="comentario-corpo">
                                <span class="nome">Cristina</span>
                                <p class="texto">Lorem ipsum dolor sit amet consectetur. Lorem ipsum</p>
                            </div>
                        </div>
                        <div class="horario-comentario">4 min</div>
                    </div>
                    <div class="container-comentario">
                        <div class="comentario">
                            <img src="https://placehold.co/36x36/E2E8F0/333?text=C" alt="Avatar Cristina" class="avatar avatar-pequeno">
                            <div class="comentario-corpo">
                                <span class="nome">Cristina</span>
                                <p class="texto">Lorem ipsum dolor sit amet consectetur. Lorem</p>
                            </div>
                        </div>
                        <div class="horario-comentario">4 min</div>
                    </div>
                </div>

                <div class="modal-rodape">
                    <div class="modal-rodape-acoes">
                        <div class="modal-rodape-icones">
                            <svg class="icone-acao icone-curtir-modal" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" clip-rule="evenodd"></path></svg>
                            <svg class="icone-acao icone-comentar-modal" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </div>
                        <svg class="icone-acao icone-enviar" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>