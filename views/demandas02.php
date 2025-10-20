<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SheepHub Dashboard</title>
    <link rel="stylesheet" href="../views/assets/css/demandas02.css">
    <script src="..views/assets/js/demandas02.js" defer></script>
</head>
<body>

    <div class="container-geral">
        <aside class="sidebar">
            <div class="sidebar-header">
                
                <span>SheepHub</span>
            </div>
            
            <nav class="sidebar-nav-main">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    Feed
                </a>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Mensagens
                </a>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect><line x1="16" x2="16" y1="2" y2="6"></line><line x1="8" x2="8" y1="2" y2="6"></line><line x1="3" x2="21" y1="10" y2="10"></line></svg>
                    Eventos
                </a>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.4 14.4H9.6L12 11.31 14.4 14.4z"/><path d="m14.4 14.4 3.6-1.8-3.6-4.11-3.6 4.11 3.6 1.8z"/><path d="M2 22v-6.23"/><path d="M22 22v-6.23"/><path d="M12 19l-8-5.7V7.55l8 4.28 8-4.28V13.3L12 19z"/></svg>
                    Igrejas
                </a>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Meu perfil
                </a>
                <a href="#" class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
                    Dashboard
                </a>
            </nav>

            <button class="postar-btn">Postar</button>

            <nav class="sidebar-nav-bottom">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    Configurações
                </a>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
                    Sair
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="search-bar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" x2="16.65" y1="21" y2="16.65"></line></svg>
                    <input type="text" placeholder="Pesquisar">
                </div>

                <div class="header-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                </div>

                <div class="user-profile">
                    <div class="user-info">
                        <span class="user-name">Clara Silva</span>
                        <span class="user-role">Membro</span>
                    </div>
                    <img src="https://i.pravatar.cc/40?img=31" alt="Foto de Clara Silva">
                </div>
                </header>

            <section class="dashboard">
                <h1>Bem vindo, Augustus!</h1>
                <h2>Dashboard</h2>

                <div class="demandas">
                    <h3>Demandas de membros</h3>
                    <div class="card-grid">
                        
                        <article class="member-card" 
                                 data-name="Juliana Silva" 
                                 data-img="https://i.pravatar.cc/80?img=49" 
                                 data-date="16/10/25 | 08:21h"
                                 data-description="Pedido de ajuda com o louvor de domingo. Preciso de mais vozes no coral e um violonista.">
                            <img src="https://i.pravatar.cc/80?img=49" alt="Foto de Juliana Silva" class="card-avatar">
                            <h4 class="card-name">Juliana Silva</h4>
                            <button class="ver-mais-btn">Ver mais</button>
                        </article>
                        
                        <article class="member-card"
                                 data-name="Bruno Costa"
                                 data-img="https://i.pravatar.cc/80?img=50"
                                 data-date="15/10/25 | 14:30h"
                                 data-description="Gostaria de organizar um grupo de estudos bíblicos nas noites de terça-feira. Alguém interessado?">
                            <img src="https://i.pravatar.cc/80?img=50" alt="Foto de Bruno Costa" class="card-avatar">
                            <h4 class="card-name">Bruno Costa</h4>
                            <button class="ver-mais-btn">Ver mais</button>
                        </article>

                        <article class="member-card"
                                 data-name="Carla Mendes"
                                 data-img="https://i.pravatar.cc/80?img=32"
                                 data-date="15/10/25 | 11:15h"
                                 data-description="Ação social de inverno: estamos coletando agasalhos e cobertores. A caixa de doação está na entrada.">
                            <img src="https://i.pravatar.cc/80?img=32" alt="Foto de Carla Mendes" class="card-avatar">
                            <h4 class="card-name">Carla Mendes</h4>
                            <button class="ver-mais-btn">Ver mais</button>
                        </article>

                        <article class="member-card"
                                 data-name="Rafael Lima"
                                 data-img="https://i.pravatar.cc/80?img=12"
                                 data-date="14/10/25 | 20:05h"
                                 data-description="Preciso de voluntários para o ministério infantil no próximo culto. Falar comigo para mais detalhes.">
                            <img src="https://i.pravatar.cc/80?img=12" alt="Foto de Rafael Lima" class="card-avatar">
                            <h4 class="card-name">Rafael Lima</h4>
                            <button class="ver-mais-btn">Ver mais</button>
                        </article>

                        <article class="member-card" 
                                 data-name="Juliana Silva" 
                                 data-img="https://i.pravatar.cc/80?img=49" 
                                 data-date="16/10/25 | 08:21h"
                                 data-description="Pedido de ajuda com o louvor de domingo. Preciso de mais vozes no coral e um violonista.">
                            <img src="https://i.pravatar.cc/80?img=49" alt="Foto de Juliana Silva" class="card-avatar">
                            <h4 class="card-name">Juliana Silva</h4>
                            <button class="ver-mais-btn">Ver mais</button>
                        </article>

                        <article class="member-card"
                                 data-name="Bruno Costa"
                                 data-img="https://i.pravatar.cc/80?img=50"
                                 data-date="15/10/25 | 14:30h"
                                 data-description="Gostaria de organizar um grupo de estudos bíblicos nas noites de terça-feira. Alguém interessado?">
                            <img src="https://i.pravatar.cc/80?img=50" alt="Foto de Bruno Costa" class="card-avatar">
                            <h4 class="card-name">Bruno Costa</h4>
                            <button class="ver-mais-btn">Ver mais</button>
                        </article>
                       
                        </div>
                </div>
            </section>
        </main>
    </div>

    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <button class="close-modal" aria-label="Fechar modal">&times;</button>
            
            <div class="modal-header">
                <img src="https://i.pravatar.cc/50?img=32" alt="Foto da pessoa" class="modal-avatar" id="modalAvatar">
                <div class="modal-info">
                    <h4 id="modalName">Nome da Pessoa</h4>
                    <span id="modalInfo">16/10/25 | 08:21h</span>
                </div>
            </div>

            <p class="modal-body" id="modalBody">
                Descrição da demanda...
            </p>

            <div class="modal-footer">
                <button class="btn btn-reject">Não aceita</button>
                <button class="btn btn-accept">Aceita</button>
            </div>
        </div>
    </div>
</body>
</html>