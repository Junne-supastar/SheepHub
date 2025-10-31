
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pega os dados do usuário logado da sessão
$usuario_nome = $_SESSION['nome'] ?? 'Visitante';
$usuario_username = $_SESSION['username'] ?? '';
$usuario_nivel = $_SESSION['nivel'] ?? 5; // 5 = visitante padrão
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SheepHub</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    /* RESET INICIAL E FONTES BASE */
* {
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif; 
    text-decoration: none;
    list-style: none;
}

/* Variáveis Globais CSS (Consolidadas) */
:root {
    /* Variáveis da pag02 */
    --secundaria-5: #FFFFFF;
    
    /* Variáveis da Navbar (pag02) */
    --nav-width: 92px;
    --nav-expanded-extra-width: 9.25rem; 
    --first-color: #7BAEC2; 
    --first-color-hover: #6696a9;
    --bg-color: #ffffff; 
    --sub-color: #B6CEFC; 
    --white-color-navbar-text: #4e4e4e; 
    
    --body-font: 'Poppins', sans-serif;
    --normal-font-size: 1rem;
    --small-font-size: .875rem;
    
    /* Z-index */
    --z-navbar: 100;
    --z-header-pag02: 98; 
    --z-sidebar-fixed: 95; 
    --z-modal-overlay: 999;
    --z-modal: 1000;
    --modal-overlay-color: rgba(0, 0, 0, 0.5);
    --modal-post-width: 448px;
    --modal-post-height: 420px;
    --modal-post-border-radius: 16px;
    --modal-post-background: #fff;
    --modal-post-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);

    /* Header */
    --header-height: 70px;
    --header-padding-horizontal: 25px;

    /* Sidebar Fixa Direita */
    --sidebar-fixed-width: 380px;
    --sidebar-fixed-top-offset: calc(var(--header-height) + 15px); /* Header + 15px margem */
    --sidebar-fixed-bottom-margin: 20px;
    --body-right-padding-gap: 15px; 
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh; 
    background-color: rgba(238, 238, 238, 0.488);
    font-family: var(--body-font); 
    position: relative;
    margin: 0;
    padding-top: var(--header-height); 
    padding-left: var(--nav-width); 
    padding-right: calc(var(--sidebar-fixed-width) + var(--sidebar-fixed-right-offset) + var(--body-right-padding-gap)); 
    transition: padding-left .5s, padding-right .5s; 
}

body.modal-active-body-overflow-hidden {
    overflow: hidden;
}
body.body-pd { 
    padding-left: calc(var(--nav-width) + var(--nav-expanded-extra-width));
}

h1 { margin: 0; }
ul { margin: 0; padding: 0; list-style: none; }
a { text-decoration: none; }

/* === ESTILOS DO MODAL === */
/* Modal de Postagem - Regras específicas */
#modal-post {
    position: fixed;
    top: 50% !important;  /* sobrescreve top anterior */
    left: 50% !important;  /* centraliza horizontalmente */
    transform: translate(-50%, -50%) !important;  /* centraliza vertical e horizontalmente */
    width: var(--modal-post-width);
    height: var(--modal-post-height);
    max-height: calc(100vh - 80px);  /* margem do topo/base */
    margin: 0;  /* remove margens */
    padding: 24px;  /* espaçamento interno uniforme */
    background: var(--modal-post-background);
    border-radius: var(--modal-post-border-radius);
    box-shadow: var(--modal-post-shadow);
    z-index: var(--z-modal);
    display: none;  /* começa invisível */
}

#modal-post.ativo {
    display: flex !important;  /* força display:flex quando ativo */
    flex-direction: column;
    opacity: 1;
    transform: translate(-50%, -50%) !important;  /* mantém centralizado */
}

/* Overlay escuro quando modal está ativo */
.modal-overlay {
    background-color: var(--modal-overlay-color) !important;  /* cor mais escura e fixa */
    backdrop-filter: blur(2px);  /* desfoque suave no fundo */
    transition: opacity 0.2s ease-in-out;
}

/* Quando qualquer modal está ativo */
body.modal-active-body-overflow-hidden .modal-overlay {
    opacity: 1;
    visibility: visible;
}

/* Área de mensagem/texto do modal */
.modal-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 20px 0;
}

/* Ícone de imagem no modal */
.modal-content .icon-imagem {
    width: 64px;
    height: 64px;
    margin-bottom: 16px;
}

/* Botão "Fotos do seu computador" */
.modal-content .botao-fotos {
    background-color: var(--first-color);
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.modal-content .botao-fotos:hover {
    background-color: var(--first-color-hover);
}

/* Input file (invisível mas funcional) */
#input-imagem {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0,0,0,0);
    border: 0;
}

.modal *, .search-container * { 
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

.search-container {
    position: relative;
    width: 350px; 
}
.search-input {
    width: 100%; 
    padding: 10px 15px 10px 40px; 
    border: 1px solid #e0e0e0;
    border-radius: 20px; 
    outline: none; 
    font-size: 14px;
    transition: all 0.25s ease; 
    background-color: #f5f5f5;
}
.search-input:hover { 
    background-color: #f0f0f0; 
}
.search-input:focus {
    background-color: #fff; border-color: var(--first-color); 
    box-shadow: 0 0 0 2px rgba(12,93,244,0.1); 
}
.search-icon {
    position: absolute; left: 15px; top: 50%;
    transform: translateY(-50%); color: #888; pointer-events: none;
}

.modal {
    position: fixed; 
    top: calc(var(--header-height) + 5px); 
    left: 50%; 
    transform: translateX(-50%) translateY(-20px); 
    width: 420px; 
    padding: 15px;
    max-height: 400px; 
    background-color: #fff; border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    z-index: var(--z-modal);
    opacity: 0; visibility: hidden;
    transition: opacity 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.1), 
                visibility 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.1),
                transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.1);
    overflow: hidden; display: flex; flex-direction: column;
.}
.modal.active,
.modal.ativo {
    opacity: 1; visibility: visible;
    transform: translateX(-50%) translateY(0);
}
.modal-overlay { position: fixed; }

/* Modal de ajuste (visual maior, centralizado): regras específicas para não afetar outros modais pequenos */
#modal-ajustar.modal {
    width: min(920px, calc(100% - 60px));
    max-height: calc(100vh - 120px);
    top: 50%;
    transform: translateX(-50%) translateY(-50%);
    padding: 0; /* conteúdo próprio controla espaçamento */
    border-radius: 12px;
    display: flex;
    align-items: stretch;
}
.modal-ajustar-conteudo {
    display: flex;
    gap: 24px;
    width: 100%;
    align-items: stretch;
}
.ajustar-imagem { 
    flex: 1; 
    padding: 20px; 
    display:flex; 
    align-items:center; 
    justify-content:center; 
}

.ajustar-imagem img#preview-ajustar { 
    width:100%; 
    height: auto; 
    border-radius: 8px; 
    max-height: calc(100vh - 240px); 
    object-fit: cover; 
    display:block; 
}

.ajustar-info { 
    width: 360px; 
    padding: 20px; 
    display:flex; 
    flex-direction:column; 
}

/* Pequenos ajustes para o modal principal (manter compacto) */
#modal-post.modal { 
    width: 420px; 
    max-height: 420px; 
    top: calc(var(--header-height) + 20px); 
    transform: translateX(-50%) translateY(-20px); 
}

.modal-overlay {
    position: fixed; 
    top: 0; 
    left: 0; 
    right: 0; 
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.233); 
    z-index: var(--z-modal-overlay);
    opacity: 0; visibility: hidden;
    transition: opacity 0.2s ease, visibility 0.2s ease;
}

.modal-overlay.active, .modal-overlay.ativo { 
    opacity: 1; 
    visibility: visible; 
}

.modal-header {
    padding: 14px 16px; 
    border-bottom: 1px solid #f0f0f0;
    display: flex; 
    justify-content: space-between; 
    align-items: center;
    flex-shrink: 0; 
}
.modal-header h2 { 
    font-size: 15px; 
    font-weight: 600; 
    color: #111; 
}
.close-btn {
    background: none; 
    border: none; 
    font-size: 20px; 
    cursor: pointer;
    color: #888; 
    padding: 4px; 
    transition: color 0.2s ease;
}
.close-btn:hover { 
    color: #333; 
}

.tabs {
    display: flex; 
    position: relative; 
    border-bottom: 1px solid #f0f0f0;
    flex-shrink: 0; 
}
.tab {
    flex: 1; 
    text-align: center; 
    padding: 12px 0; 
    cursor: pointer;
    font-weight: 500; 
    font-size: 13px; 
    color: #666; 
    transition: all 0.2s ease;
}
.tab:hover { 
    color: #333; 
}
.tab.active { 
    color: var(--first-color); 
}
.indicator {
    position: absolute; bottom: 0; left: 0; 
    height: 3px; 
    border-radius: 10px;
    background-color: var(--first-color); 
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.1);
    width: 0; 
}

.modal-content-wrapper { 
    flex-grow: 1; 
    overflow-y: auto; 
    scrollbar-width: thin; 
    scrollbar-color: #e0e0e0 transparent;
}
.modal-content-wrapper::-webkit-scrollbar { 
    width: 6px; 
}
.modal-content-wrapper::-webkit-scrollbar-thumb { 
    background-color: #e0e0e0; 
    border-radius: 3px; 
}

.tab-content { 
    display: none; 
}
.tab-content.active { 
    display: block; 
    animation: fadeIn 0.25s ease; 
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

.account-item, .post-item, .job-item {
    padding: 12px 16px; 
    border-bottom: 1px solid #f5f5f5;
    transition: background-color 0.2s ease;
}
.account-item:last-child, .post-item:last-child, .job-item:last-child {
    border-bottom: none; 
}
.account-item:hover, .post-item:hover, .job-item:hover { 
    background-color: #f9f9f9; 
}

.account-item { 
    display: flex; align-items: center;
 }
.account-avatar {
    width: 36px; 
    height: 36px; 
    border-radius: 50%; 
    background-color: #e0e0e0;
    display: flex; 
    align-items: center; 
    justify-content: center;
    margin-right: 12px; 
    color: #555; 
    font-size: 14px; 
    font-weight: 500; 
    flex-shrink: 0;
}
.account-info { 
    flex: 1; 
    min-width: 0; 
}
.account-name {
    font-weight: 500; 
    font-size: 14px; 
    color: #111;
    white-space: nowrap; 
    overflow: hidden; 
    text-overflow: ellipsis;
}
.account-type { 
    font-size: 12px; 
    color: #888; 
    margin-top: 2px; 
}

.post-item { 
    padding: 16px; 
} 
.post-header { 
    display: flex; 
    align-items: center; 
    margin-bottom: 10px; 
}
.post-avatar {
    width: 32px; 
    height: 32px; 
    border-radius: 50%; 
    background-color: #e0e0e0;
    display: flex; 
    align-items: center; 
    justify-content: center;
    margin-right: 10px; 
    color: #555; 
    font-size: 13px; 
    font-weight: 500; 
    flex-shrink: 0;
}
.post-user { 
    font-weight: 500; 
    font-size: 13px; color: #111; 
}
.post-time { 
    font-size: 11px; 
    color: #888; 
    margin-left: 6px; 
}
.post-image-container { 
    margin-bottom: 10px; 
    padding-left: 42px; 
}
.post-image {
    width: 100%; 
    border-radius: 8px; 
    margin-bottom: 8px; 
    display: block;
    max-height: 180px; 
    object-fit: cover;
}
.post-description { 
    font-size: 13px; 
    line-height: 1.4; 
    color: #555; 
}
.post-stats {
    display: flex; 
    align-items: center; 
    font-size: 12px; 
    color: #888;
    padding-left: 42px; 
    margin-top: 8px;
}
.post-stat { 
    display: flex; 
    align-items: center; 
    margin-right: 12px; 
}


.quick-actions {
    display: flex; 
    padding: 8px 16px; 
    border-top: 1px solid #f0f0f0;
    background-color: #fafafa; 
    flex-shrink: 0; 
}
.action-btn {
    flex: 1; 
    text-align: center; 
    padding: 8px; 
    font-size: 12px;
    color: #555; 
    cursor: pointer; 
    border-radius: 6px; 
    transition: all 0.2s ease;
}
.action-btn:hover { 
    background-color: #f0f0f0; 
    color: #111; 
}

/* === ESTILOS DA NAVBAR LATERAL (pag02) === */
.l-navbar{
    position: fixed; top: 0; left: 0; 
    width: var(--nav-width); height: 100vh;
    background-color: var(--bg-color);
    box-shadow: 0px 0px 20px rgba(170, 170, 170, 0.2); 
    color: var(--white-color-navbar-text); 
    padding: 1.5rem 1.5rem 2rem;
    transition: width .5s; 
    z-index: var(--z-navbar);
}
.nav{
    height: 100%; 
    display: flex; 
    flex-direction: column;
    justify-content: space-between; 
    overflow: hidden;
}
.nav__brand{
    display: grid; 
    grid-template-columns: max-content max-content;
    justify-content: space-between; 
    align-items: center; 
    margin-bottom: 2rem;
}
.nav__toggle{ 
    font-size: 1.25rem; 
    padding: .75rem; 
    cursor: pointer; 
}

.nav__logo{ 
    color: var(--white-color-navbar-text); 
    font-weight: 600; 
}
.nav__link{
    display: grid; 
    grid-template-columns: max-content max-content;
    align-items: center; 
    column-gap: .75rem; 
    padding: .75rem;
    color: var(--white-color-navbar-text); 
    border-radius: .5rem;
    margin-bottom: 1rem; 
    transition: .3s; 
    cursor: pointer;
}
.nav__link:hover{
    background-color: var(--first-color);
    color: var(--secundaria-5); 
}
.nav__link:hover .nav__icon,
.nav__link:hover .nav__name {
    color: var(--secundaria-5); 
}
.nav__icon{ 
    font-size: 1.25rem; 
}

.nav__name{ 
    font-size: var(--small-font-size); 
}

.l-navbar.expander{ 
    width: calc(var(--nav-width) + var(--nav-expanded-extra-width)); 
}

.nav__link.active{
    background-color: var(--first-color);
    color: var(--secundaria-5); 
}
.nav__link.active .nav__icon,
.nav__link.active .nav__name {
    color: var(--secundaria-5); 
}
.collapse{ 
    grid-template-columns: 20px max-content 1fr; 
}
.collapse__link{ 
    justify-self: flex-end; 
    transition: .5s; 
}
.collapse__menu{ 
    display: none; 
    padding: .75rem 2.25rem; 
    transition: 0.5s; 
}

.collapse__sublink{ 
    color: var(--sub-color); 
    font-size: var(--small-font-size); 
}

.collapse__sublink:hover{ 
    color: var(--secundaria-5); 
}
.showCollapse{ 
    display: block; 
}

.nav__link.active .collapse__sublink {
    color: var(--secundaria-5); 
    opacity: 0.7;
}

.collapse__sublink.active {
    color: var(--secundaria-5); 
    opacity: 1; 
}


.nav__link.active .collapse__sublink:hover {
    opacity: 1;
}
.rotate{ 
    transform: rotate(180deg); }

/* === HEADER DA PAG02 (FIXO, Layout Anterior Restaurado) === */
header.page-header { 
    
    left: var(--nav-width); 
    width: calc(100% - var(--nav-width)); 
    height: var(--header-height);
    padding: 0 var(--header-padding-horizontal); 
    display: flex;
    
    justify-content: space-between; 
    align-items: center;
    background-color: #fff;
    border-bottom: 1px solid rgba(197, 197, 197, 0.658);
    position: fixed; 
    top: 0;
    z-index: var(--z-header-pag02);
    transition: width 0.5s, left 0.5s; 
}
body.body-pd header.page-header {
   
    left: calc(var(--nav-width) + var(--nav-expanded-extra-width));
    width: calc(100% - (var(--nav-width) + var(--nav-expanded-extra-width)));
}


.header-right-content {
    display: flex; 
    align-items: center; 
    gap: 20px;
    
}
.direita-header a button{
    background-color: var(--first-color); color: var(--secundaria-5);
    padding: 10px 20px; border-radius: 30px; cursor: pointer;
    display: flex; align-items: center; gap: 8px; 
    font-size: 14px; 
}
.direita-header a button i { font-size: 1.2em; } 
header.page-header figure.profile-avatar { 
    width: 45px; height: 45px;
    background-color: #ccc; 
    background-size: cover; background-position: center;
    border-radius: 10px; cursor: pointer;
}

.info-user {
    display: flex;
    flex-direction: column;
}

.info-user h3 {
    font-size: 1.0rem;
    color: rgb(10, 10, 10);
}

.info-user p {
    font-size: 0.9rem;
    color: gray;
}

.area-perfil {
    display: flex;
    gap: 20px
}


.nav__link i {
    font-size: 1.2rem;
}

.icon-bell {
    background-color: var(--first-color);
    width: 35px;
    height: 35px;
    border-radius: 50%;

    display: flex;
    justify-content: center;
    align-items: center;

    cursor: pointer;
    transition: 0.3s;
}

.icon-bell i {
    font-size: 1.2rem;
    color: white;
}

.icon-bell:hover {
    background-color: var(--first-color-hover);
}

/* Deixa o ícone do sino com cursor de clique */
.container-notifications {
    cursor: pointer;
}

/* Estilos para os itens da lista de notificações */
.notification-item {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.2s;
}

.notification-item:hover {
    background-color: #f9f9f9;
}

.notification-item.unread {
    background-color: #f4f8ff; 
    font-weight: 500;
}

.notification-avatar {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 50%;
    margin-right: 15px;
    overflow: hidden;
}

.notification-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.notification-info {
    display: flex;
    flex-direction: column;
}

.notification-text {
    font-size: 14px;
    color: #333;
    line-height: 1.4;
}

.notification-text strong {
    font-weight: 600;
}

.notification-time {
    font-size: 12px;
    color: #888;
    margin-top: 3px;
}

.quick-actions .mark-as-read {
    font-size: 13px;
    color: var(--first-color-hover); 
    text-decoration: none;
    padding: 0 20px;
    display: inline-block;
    margin-top: 10px; 
}

.quick-actions .mark-as-read:hover {
    text-decoration: underline;
}

#notificationsModal {
    left: 73%;
}

  </style>
</head>
<body>
<header class="page-header">
        <div class="search-container" style=" width: 70%; margin: 0px 30px;">
            <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" class="search-input" placeholder="Pesquisar..." id="searchTrigger">
        </div>

        <div class="container-notifications" id="notificationsTrigger">
            <div class="icon-bell">
                <i class="bi bi-bell"></i>
            </div>
        </div>

        <div class="header-right-content" style=" width: 30%; display: flex; justify-content: flex-end;">
            <a href="perfil-empresa.html">

                            <div class="area-perfil">
                    <div class="info-user">
                        <h3><?= htmlspecialchars($usuario_nome) ?></h3>
                        <p><?php
                            switch($usuario_nivel){
                                case 1: echo "Admin"; break;
                                case 2: echo "Instituição"; break;
                                case 3: echo "Líder de comunidade"; break;
                                case 4: echo "Membro"; break;
                                default: echo "Visitante"; break;
                            }
                        ?></p>
                    </div>
                    <figure class="profile-avatar">
                        <img src="../assets/img/user-icon-sidebar.jpg" alt="Avatar do Usuário" style="width:100%; height:100%; border-radius:inherit; object-fit:cover;">
                    </figure>
                </div>
            </a>
        </div>
    </header>

    <div class="modal" id="notificationsModal">
    <div class="modal-header">
        <h2>Notificações</h2>
        <button class="close-btn" id="closeNotificationsModalBtn">&times;</button>
    </div>
    
    <div class="tabs">
        <div class="tab active" data-tab="all-notifications">Todas</div>
        <div class="tab" data-tab="unread-notifications">Não lida</div>
        <div class="indicator" id="notificationsIndicator"></div>
    </div>
    
    <div class="modal-content-wrapper">
        <div class="tab-content active" id="all-notifications">
            <div class="notification-item">
                <div class="notification-avatar">
                    <img src="https://i.pravatar.cc/80?u=joaopereira" alt="Avatar João">
                </div>
                <div class="notification-info">
                    <div class="notification-text">
                        <strong>João Pereira</strong> curtiu sua publicação: "Novas tendências..."
                    </div>
                    <div class="notification-time">2 horas atrás</div>
                </div>
            </div>
            <div class="notification-item">
                <div class="notification-avatar">
                    <img src="https://i.pravatar.cc/80?u=nexus" alt="Avatar Nexus">
                </div>
                <div class="notification-info">
                    <div class="notification-text">
                        <strong>Nexus Innovations Ltd.</strong> começou a seguir você.
                    </div>
                    <div class="notification-time">1 dia atrás</div>
                </div>
            </div>
             <div class="notification-item unread"> <div class="notification-avatar">
                    <img src="https://i.pravatar.cc/80?u=anasilva" alt="Avatar Ana Silva">
                </div>
                <div class="notification-info">
                    <div class="notification-text">
                        <strong>Ana Silva</strong> enviou uma nova mensagem.
                    </div>
                    <div class="notification-time">5 minutos atrás</div>
                </div>
            </div>
        </div>
        
        <div class="tab-content" id="unread-notifications">
            <div class="notification-item unread">
                <div class="notification-avatar">
                    <img src="https://i.pravatar.cc/80?u=anasilva" alt="Avatar Ana Silva">
                </div>
                <div class="notification-info">
                    <div class="notification-text">
                        <strong>Ana Silva</strong> enviou uma nova mensagem.
                    </div>
                    <div class="notification-time">5 minutos atrás</div>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="quick-actions">
        <a href="#" class="mark-as-read">Marcar todas como lidas</a>
    </div>
</div>  

    <div class="modal" id="searchModal">
        <div class="modal-header">
            <h2>Resultados da Pesquisa</h2>
            <button class="close-btn" id="closeModalBtn">&times;</button>
        </div>
        
        <div class="tabs">
            <div class="tab active" data-tab="accounts"></div>
            <div class="indicator" id="indicator"  style="background-color: white;"></div>
        </div>
        
        <div class="modal-content-wrapper">
            <div class="tab-content active" id="accounts">
                <div class="account-item">
                    <div class="account-avatar">
                        <img src="https://i.pravatar.cc/80?u=mamal" alt="Avatar MAMAL" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    </div>
                    <div class="account-info">
                        <div class="account-name">MAMAL Global Solutions</div>
                        <div class="account-type">Usuário</div>
                    </div>
                </div>
                <div class="account-item">
                    <div class="account-avatar">
                        <img src="https://i.pravatar.cc/80?u=nexus" alt="Avatar Nexus" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    </div>
                    <div class="account-info">
                        <div class="account-name">Nexus Innovations Ltd.</div>
                        <div class="account-type">Empresa</div>
                    </div>
                </div>
                <div class="account-item">
                    <div class="account-avatar">
                         <img src="https://i.pravatar.cc/80?u=anasilva" alt="Avatar Ana Silva" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    </div>
                    <div class="account-info">
                        <div class="account-name">Ana Silva Design Studio</div>
                        <div class="account-type">Designer</div>
                    </div>
                </div>
                <div class="account-item">
                    <div class="account-avatar">
                        <img src="https://i.pravatar.cc/80?u=joaopereira" alt="Avatar João Pereira" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    </div>
                    <div class="account-info">
                        <div class="account-name">João Pereira Consultoria</div>
                        <div class="account-type">Consultor</div>
                    </div>
                </div>
            </div>
            
                
            
        </div> 
        
        <div class="quick-actions">
            <br> 
        </div>
    </div>
    
    <div class="modal-overlay" id="modalOverlay"></div>

    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <div class="nav__brand">
                    <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                    <a href="/SheepHub/views/feed/feed.php" class="nav__logo">
                        <p>SheepHub</p>
                    </a>
                </div>
                <div class="nav__list">
                    <a href="/SheepHub/views/feed/feed04.php" class="nav__link">
                        <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Feed</span>
                    </a>

                    <a href="/SheepHub/views/mensagens/batepapo.php" class="nav__link">
                        <ion-icon name="chatbubbles-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Mensagens</span>
                    </a>

                    <a href="/SheepHub/views/eventos/eventos02.php" class="nav__link">
                        <i class="bi bi-calendar4-event" class="nav__icon"></i>
                        <span class="nav__name">Eventos</span>
                    </a>

                    <a href="/SheepHub/views/igrejas/igrejas.php" class="nav__link">
                        <i class="bi bi-house-heart" class="nav__icon"></i>
                        <span class="nav__name">Igrejas</span>
                    </a>

                    <div class="nav__link collapse">
                        <ion-icon name="pie-chart-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Dashboard</span>

                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                        <ul class="collapse__menu">
                            <a href="/SheepHub/views/dashboard/dashboard_financas.php" class="collapse__sublink">Finanças</a>
                            <a href="/SheepHub/views/dashboard/criarMeta.php" class="collapse__sublink">Metas</a>
                            <a href="/SheepHub/views/dashboard/Membros.php" class="collapse__sublink">Membros</a>
                            <a href="/SheepHub/views/dashboard/demandas02.php" class="collapse__sublink">Demandas</a>
                            <a href="/SheepHub/views/dashboard/caixinha/caixinha.php" class="collapse__sublink">Caixinha</a>
                        </ul>
                    </div>
                    
                    <a href="javascript:void(0);" class="nav__link menu-postar-btn botao-postar">
                        <i class="bi bi-plus-circle"></i>
                        <span class="nav__name">Postar</span>
                    </a>

                    <a href="/SheepHub/views/configuracoes/config.php" class="nav__link">
                        <ion-icon name="settings-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Configurações</span>
                    </a>
                </div>
            </div>

            
            <a href="/SheepHub/public/logout.php" class="nav__link">
                <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                <span class="nav__name">Sair</span>
            </a>
        </nav>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Lógica da Navbar Lateral (sem alterações)
    const showMenu = (toggleId, navbarId, bodyId) => {
        const toggle = document.getElementById(toggleId),
              navbar = document.getElementById(navbarId),
              bodyEl = document.body;

        if (toggle && navbar && bodyEl) {
            toggle.addEventListener('click', () => {
                navbar.classList.toggle('expander');
                bodyEl.classList.toggle('body-pd');
                if (window.innerWidth <= 768 && navbar.classList.contains('expander')) {
                    bodyEl.classList.add('navbar-expanded-mobile');
                } else {
                    bodyEl.classList.remove('navbar-expanded-mobile');
                }
            });
        }
    };
    showMenu('nav-toggle', 'navbar', 'body');

    /* ===== CÓDIGO NOVO INSERIDO AQUI ===== */
    const setActiveLink = () => {
    
        const currentPage = window.location.pathname.split('/').pop();

        // Seleciona todos os links, incluindo os do menu "Adm"
        const navLinks = document.querySelectorAll('.nav__link, .collapse__sublink');

        navLinks.forEach(link => {
            const linkPage = link.getAttribute('href');

            if (linkPage === currentPage) {
                link.classList.add('active');

                // Se o link ativo for um sub-link (dentro de "Adm")
                const parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    // Adiciona 'active' também ao item principal "Adm"
                    parentCollapse.classList.add('active');
                    
                    // Expande o menu para mostrar o sub-link ativo
                    const menu = parentCollapse.querySelector('.collapse__menu');
                    const chevron = parentCollapse.querySelector('.collapse__link');
                    if (menu) menu.classList.add('showCollapse');
                    if (chevron) chevron.classList.add('rotate');
                }
            }
        });
    };
    setActiveLink();
    /* ===== FIM DO CÓDIGO NOVO ===== */


    // Lógica do menu collapse (sem alterações)
    const linkCollapse = document.querySelectorAll('.nav__link.collapse');
    linkCollapse.forEach(link => {
        const chevron = link.querySelector('.collapse__link');
        const menu = link.querySelector('.collapse__menu');
        if (chevron && menu) {
            link.addEventListener('click', function(e) {
                if (!menu.contains(e.target) && e.target !== chevron && !chevron.contains(e.target)) {
                }
                // Toggle logic
                if (e.target === link || link.querySelector('.nav__name').contains(e.target) || link.querySelector('.nav__icon').contains(e.target) || e.target === chevron || chevron.contains(e.target)) {
                    menu.classList.toggle('showCollapse');
                    chevron.classList.toggle('rotate');
                }
            });
        }
    });

    // O restante do seu código original permanece igual
    
    /* ===============================================================
       INÍCIO DA SUBSTITUIÇÃO - SUA ANTIGA setupModal FOI TROCADA POR ESTA
       ===============================================================
    */
    const setupModals = () => {
        // --- Elementos Comuns ---
        const modalOverlay = document.getElementById('modalOverlay');
        const bodyElement = document.body;

        // --- Modal de Pesquisa (Elementos) ---
        const searchTrigger = document.getElementById('searchTrigger');
        const searchModal = document.getElementById('searchModal');
        const closeSearchModalBtn = document.getElementById('closeModalBtn');

        // --- Modal de Notificações (Novos Elementos) ---
        const notificationsTrigger = document.getElementById('notificationsTrigger');
        const notificationsModal = document.getElementById('notificationsModal');
        const closeNotificationsModalBtn = document.getElementById('closeNotificationsModalBtn');

        // Se não tiver overlay, não faz nada
        if (!modalOverlay) {
            return;
        }

        // --- Função Genérica para Fechar Modais ---
        const closeModal = (modal) => {
            if (modal) {
                modal.classList.remove('active');
            }
            // Só esconde o overlay se NENHUM modal estiver ativo
            if (!searchModal?.classList.contains('active') && !notificationsModal?.classList.contains('active')) {
                modalOverlay.classList.remove('active');
                bodyElement.classList.remove('modal-active-body-overflow-hidden');
            }
        };

        // --- Função Genérica para Configurar Abas ---
        // (Isso pega sua lógica original e a torna reutilizável)
        const setupTabSystem = (modal) => {
            if (!modal) return null;

            const tabs = modal.querySelectorAll('.tab');
            const tabContents = modal.querySelectorAll('.tab-content');
            // IMPORTANTE: Cada modal deve ter seu PRÓPRIO indicador com a classe '.indicator'
            const indicator = modal.querySelector('.indicator'); 

            if (!tabs.length || !tabContents.length || !indicator) {
                return null; // Não há sistema de abas neste modal
            }

            // Função para posicionar o indicador (baseada na sua)
            const positionIndicator = (element) => {
                if (element && indicator) {
                    indicator.style.width = `${element.offsetWidth}px`;
                    indicator.style.left = `${element.offsetLeft}px`;
                } else if (indicator) {
                    indicator.style.width = `0px`;
                }
            };

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));

                    this.classList.add('active');
                    const targetContentId = this.getAttribute('data-tab');
                    // Busca o ID dentro do modal atual
                    const targetContent = modal.querySelector('#' + targetContentId); 
                    if (targetContent) {
                        targetContent.classList.add('active');
                    }
                    positionIndicator(this);
                });
            });

            // Posição inicial
            const initialActiveTab = modal.querySelector('.tab.active');
            positionIndicator(initialActiveTab);

            // Retorna a função de posicionar para ser usada no 'openModal'
            return positionIndicator;
        };

        // --- Configura as abas para CADA modal ---
        const positionSearchIndicator = setupTabSystem(searchModal);
        const positionNotificationsIndicator = setupTabSystem(notificationsModal);

        // --- Função Genérica para Abrir Modais ---
        const openModal = (modal) => {
            if (!modal) return;

            // Fecha qualquer outro modal que esteja aberto
            if (modal === searchModal) closeModal(notificationsModal);
            if (modal === notificationsModal) closeModal(searchModal);

            // Abre o modal solicitado
            modal.classList.add('active');
            modalOverlay.classList.add('active');
            bodyElement.classList.add('modal-active-body-overflow-hidden');

            // Reposiciona o indicador do modal que acabou de abrir
            // (Esta era a sua lógica original de 'openSearchModal')
            if (modal === searchModal && positionSearchIndicator) {
                positionSearchIndicator(searchModal.querySelector('.tab.active'));
            } else if (modal === notificationsModal && positionNotificationsIndicator) {
                positionNotificationsIndicator(notificationsModal.querySelector('.tab.active'));
            }
        };

        // --- Conecta os Eventos ---

        // 1. Abrir Modais
        if (searchTrigger) {
            searchTrigger.addEventListener('click', () => openModal(searchModal));
            searchTrigger.addEventListener('focus', () => openModal(searchModal)); // Mantém sua lógica de foco
        }
        if (notificationsTrigger) {
            notificationsTrigger.addEventListener('click', () => openModal(notificationsModal));
        }

        // 2. Fechar Modais (Botões 'X')
        if (closeSearchModalBtn) {
            closeSearchModalBtn.addEventListener('click', () => closeModal(searchModal));
        }
        if (closeNotificationsModalBtn) {
            closeNotificationsModalBtn.addEventListener('click', () => closeModal(notificationsModal));
        }

        // 3. Fechar Modais (Overlay)
        modalOverlay.addEventListener('click', () => {
            closeModal(searchModal);
            closeModal(notificationsModal);
        });

        // 4. Fechar Modais (Tecla 'Esc')
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (searchModal?.classList.contains('active')) {
                    closeModal(searchModal);
                }
                if (notificationsModal?.classList.contains('active')) {
                    closeModal(notificationsModal);
                }
            }
        });
    };
    /* ===============================================================
       FIM DA SUBSTITUIÇÃO
       ===============================================================
    */


    const setupAgendamentos = () => {
        const btnEditar = document.getElementById('btnEditar');
        const btnSalvar = document.getElementById('btnSalvar');
        const containerAgendamentos = document.getElementById('agendamentos');

        if (!btnEditar || !btnSalvar || !containerAgendamentos) {
            return;
        }

        let editMode = false;

        const entrarModoEdicao = () => {
            editMode = true;
            btnSalvar.style.display = 'block';
            btnEditar.style.display = 'none';
            const cards = containerAgendamentos.querySelectorAll('.card-agendamento');

            cards.forEach(card => {
                card.classList.remove('selecionado');
                const dataDiv = card.querySelector('.data-card');
                const textoDiv = card.querySelector('.texto-agenda');

                if (dataDiv && !card.querySelector('.data-input')) {
                    const dataInput = document.createElement('input');
                    dataInput.className = 'data-input';
                    dataInput.type = 'text';
                    dataInput.value = dataDiv.innerText.replace("\n", " ");
                    card.replaceChild(dataInput, dataDiv);
                }
                if (textoDiv && !card.querySelector('.texto-input')) {
                    const textoInput = document.createElement('textarea');
                    textoInput.className = 'texto-input';
                    textoInput.value = textoDiv.innerText;
                    card.replaceChild(textoInput, textoDiv);
                    textoInput.style.height = 'auto';
                    textoInput.style.height = (textoInput.scrollHeight) + 'px';
                    textoInput.addEventListener('input', () => {
                        textoInput.style.height = 'auto';
                        textoInput.style.height = (textoInput.scrollHeight) + 'px';
                    });
                }
            });
        };
        const salvarEdicoes = () => {
            editMode = false;
            const cards = containerAgendamentos.querySelectorAll('.card-agendamento');
            cards.forEach(card => {
                const dataInput = card.querySelector('.data-input');
                const textoInput = card.querySelector('.texto-input');
                if (dataInput) {
                    const dataDiv = document.createElement('div');
                    dataDiv.className = 'data-card';
                    dataDiv.innerHTML = dataInput.value.replace(/(\d+)\s*([a-zA-ZÀ-ú]+)/, '$1<br>$2');
                    card.replaceChild(dataDiv, dataInput);
                }
                if (textoInput) {
                    const textoDiv = document.createElement('div');
                    textoDiv.className = 'texto-agenda';
                    textoDiv.innerText = textoInput.value;
                    card.replaceChild(textoDiv, textoInput);
                }
            });
            btnSalvar.style.display = 'none';
            btnEditar.style.display = 'inline-block';
        };
        const setupCardsSelecao = () => {
            containerAgendamentos.addEventListener('click', function(event) {
                const card = event.target.closest('.card-agendamento');
                if (card && !editMode) {
                    card.classList.toggle('selecionado');
                }
            });
        };
        btnEditar.addEventListener('click', entrarModoEdicao);
        btnSalvar.addEventListener('click', salvarEdicoes);
        setupCardsSelecao();
    };

    function updateDateTime() {
        const now = new Date();
        const timeEl = document.getElementById('current-time');
        const dateEl = document.getElementById('current-date');

        if (timeEl) {
            timeEl.textContent = now.toLocaleTimeString('pt-BR', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
        if (dateEl) {
            const day = now.toLocaleDateString('pt-BR', {
                day: '2-digit'
            });
            const month = now.toLocaleDateString('pt-BR', {
                month: 'short'
            }).replace('.', '');
            const weekday = now.toLocaleDateString('pt-BR', {
                weekday: 'short'
            }).replace('.', '');
            dateEl.textContent = `${weekday}, ${day} de ${month}`;
        }
    }
    updateDateTime();
    setInterval(updateDateTime, 60000);

    setupModals(); // <-- CHAMADA ATUALIZADA
    setupAgendamentos();
});


</script>

<?php
// Inclui os modais globais (HTML dos modais) e carrega o script de postagem
// Dessa forma o botão '+' na sidebar abre o modal em todas as páginas
include __DIR__ . '/modals.php';
?>
<script src="/SheepHub/views/assets/js/post-handler.js"></script>

</body>
</html>
