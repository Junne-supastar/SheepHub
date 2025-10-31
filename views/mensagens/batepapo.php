<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Limpo (HTML, CSS, JS)</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/batepapo.css">
    <script src="../assets/js/batepapo.js" defer></script>

</head>
<body>
<?php include '../includes/sidebar.php'; ?>
    <div class="container-aplicativo">
        <main class="container-chat">
            <aside class="sidebar-contatos">
                <div class="sidebar-cabecalho">
                    <h1>Conversas</h1>
                </div>
                
                <div class="barra-busca">
                    <span class="icone-busca">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </span>
                    <input type="text" id="input-busca" placeholder="Buscar usuário..." class="input-busca">
                </div>
                
                <div id="lista-contatos" class="lista-contatos">
                    </div>
            </aside>

            <section class="janela-chat">
                <header id="chat-cabecalho" class="chat-cabecalho">
                    </header>
                
                <div id="area-mensagens" class="area-mensagens">
                    </div>
                
                <footer id="container-input-mensagem" class="container-input-mensagem">
                    <div class="container-input">
                        <input type="text" id="campo-input-mensagem" placeholder="Digite uma mensagem..." class="input-mensagem">
                        <button class="botao-enviar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </div>
                </footer>
            </section>
        </main>
    </div>

</body>
</html>