<?php
session_start();

// Redireciona se não estiver logado
if (!isset($_SESSION['idusuario'])) {
    header("Location: /SheepHub/public/index.php");
    exit;
}

require_once __DIR__ . '/../config/Conexao.php';
require_once __DIR__ . '/../models/PerfilInstituicao.php';
require_once __DIR__ . '/../controllers/PerfilinstituicaoController.php';

// Pega a conexão PDO
$pdo = Conexao::getConexao();

// Cria o model e o controller
$model = new PerfilInstituicao ($pdo);
$perfilController = new PerfilInstituicaoController($model);

// Busca dados do usuário logado
$idusuario = $_SESSION['idusuario'];
$usuario = $perfilController->model->getUsuario($idusuario);
$perfil = $perfilController->model->getPerfilInstituicao($idusuario);

// Verifica se o perfil existe
if (!$perfil) {
    // Se não existir, redireciona para o formulário de criação/edição de perfil
    header("Location: /SheepHub/rotas/cadastro-perfil-instituicao-salvar.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil líder</title>
    <link rel="stylesheet" href="/SheepHub/views/assets/css/perfil-lider.css">
    <script src="/SheepHub/views/assets/js/perfil-lider.js" defer></script>
</head>
<body>
<div class="container-geral">
    <aside id="menu-lateral" class="menu-lateral">
        <a href="#" class="logo"><span>SheepHub</span></a>
        <nav>
            <a href="#" class="link-navegacao"><span>Feed</span></a>
            <a href="#" class="link-navegacao"><span>Mensagens</span></a>
            <a href="#" class="link-navegacao"><span>Eventos</span></a>
            <a href="#" class="link-navegacao"><span>Igrejas</span></a>
            <a href="#" class="link-navegacao"><span>Meu perfil</span></a>
            <a href="#" class="link-navegacao ativo"><span>Dashboard</span></a>
            <button class="botao-postar">Postar</button>
        </nav>
        <div>
            <a href="#" class="link-navegacao"><span>Configurações</span></a>
            <a href="#" class="link-navegacao"><span>Sair</span></a>
        </div>
    </aside>

    <div id="fundo-overlay" class="hidden"></div>
    <div class="conteudo-principal">
        <header class="cabecalho">
            <button id="botao-menu" class="botao-menu"></button>
            <div class="busca-container">
                <input type="text" placeholder="Pesquisar" class="campo-busca">
            </div>
            <div class="acoes-cabecalho">
                <div class="info-perfil">
                    <div class="texto-perfil">
                        <p><strong><?= htmlspecialchars($usuario['nome']) ?></strong></p>
                        <p style="font-size: 0.8rem; color: var(--cor-texto-secundario)">Líder</p>
                    </div>
                 <img src="/SheepHub/views/assets/uploads/<?= htmlspecialchars($perfil['foto_perfil'] ?? 'default.png') ?>" 
         alt="Foto de perfil da instituição">
                </div>
            </div>
        </header>

        <div class="container01">
            <main class="banner-principal">
                <div class="circle-perfil">
       <img src="/SheepHub/views/assets/uploads/<?= htmlspecialchars($perfil["foto_perfil"] ?? "default.png") ?>" alt="Foto de perfil do membro">
                </div>
            </main>

            <div class="descricao-perfil">
                <div class="descricao-geral-perfil-empresa">
                    <div class="lado1">
                        <div class="text-lado1">
                            <div class="nome-usuario">
                                <h2><?= htmlspecialchars($usuario['nome']) ?></h2>
                                <p><?= htmlspecialchars($usuario['username'] ) ?></p>
                            </div>
                            <div class="descricao-container">
                                <p class="descricao"><?= htmlspecialchars($perfil['descricao']) ?></p>
                            </div>
                            <div class="informacoes-base">
                           <span>
                                    <img src="/SheepHub/views/assets/img/vetor03-perfil.svg" alt="">
                   <p>Entrou em <?= htmlspecialchars($usuario['dt_criacao'] ?? 'Não informado') ?></p>
                                </span>
                                <span>
                                    <img src="/SheepHub/views/assets/img/vetor01-perfil.svg" alt="">
                                    <p><?= htmlspecialchars($perfil['cep']) ?></p>
                                </span>
                                <span>
                                    <img src="/SheepHub/views/assets/img/vetor02-perfil.svg" alt="">
                                    <p><?= htmlspecialchars($perfil['telefone']) ?></p>
                                </span>
                            </div>
                        </div>

                        <div class="text-lado2">
                            <a href="editar-perfil-empresa.php"><button>Editar perfil</button></a>
                        </div>
                    </div>

                <div class="lado2">
                    <a href="#" class="tab-link active"  data-tab="perfil">Perfil</a>
                    <a href="#" class="tab-link" data-tab="marcados">Marcados</a>
                    <div class="underline"></div> <!-- Linha que desliza -->
                </div>
            </div>

        </div>
    </div>


    <div class="tab-content" id="perfil">
        <div class="container-post">
            <a href="#">
                <div class="post" id="post01">
                    <img src="/SheepHub/views/assets/img/img01-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post02">
                    <img src="/SheepHub/views/assets/img/img02-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post03">
                    <img src="/SheepHub/views/assets/img/img03-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post04">
                    <img src="/SheepHub/views/assets/img/img06-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post05">
                    <img src="/SheepHub/views/assets/img/img05-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post06">
                    <img src="/SheepHub/views/assets/img/img06-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post07">
                    <img src="/SheepHub/views/assets/img/img07-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post08">
                    <img src="/SheepHub/views/assets/img/img08-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post01">
                    <img src="/SheepHub/views/assets/img/img01-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post02">
                    <img src="/SheepHub/views/assets/img/img02-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post03">
                    <img src="/SheepHub/views/assets/img/img03-perfil-lider.png" alt="">
                </div>
            </a>
            <a href="#">
                <div class="post" id="post04">
                    <img src="/SheepHub/views/assets/img/img06-perfil-lider.png" alt="">
                </div>
            </a>
           
        </div>
        
    </div>


    <div class="tab-content"  id="marcados" style="display: none;">
        <div class="container-marcados">

            <article class="post-marcado">
        
                <header class="post-header">
                    
                    <a href="#" class="post-link-perfil">
                        <img src="/assets/img/img05-perfil-lider.png" alt="foto perfil" class="post-avatar">
                    </a>
        
                    <div class="post-info-usuario">
                        <a href="#" class="post-nome-usuario">Rodolfo</a>
                        <p class="post-localizacao-usuario">Rio de Janeiro</p>
                    </div>
                    
                </header>
        
                <div class="post-corpo">
                    <a href=""><img src="/assets/img/img04-perfil-lider.png" alt="Foto marcada" class="post-imagem"></a>
                </div>
                
            </article>

            <article class="post-marcado">
        
                <header class="post-header">
                    
                    <a href="#" class="post-link-perfil">
                        <img src="/assets/img/img03-perfil-lider.png" alt="foto perfil" class="post-avatar">
                    </a>
        
                    <div class="post-info-usuario">
                        <a href="#" class="post-nome-usuario">Rodolfo</a>
                        <span class="post-localizacao-usuario">Rio de Janeiro</span>
                    </div>
                    
                    </header>
        
                <div class="post-corpo">
                    <a href="#"><img src="/assets/img/img02-perfil-membro.png" alt="Foto marcada" class="post-imagem"></a>
                </div>
                
            </article>

            <article class="post-marcado">
        
                <header class="post-header">
                    
                    <a href="#" class="post-link-perfil">
                        <img src="/assets/img/img07-perfil-lider.png" alt="foto perfil" class="post-avatar">
                    </a>
        
                    <div class="post-info-usuario">
                        <a href="#" class="post-nome-usuario">Rodolfo</a>
                        <p class="post-localizacao-usuario">Rio de Janeiro</p>
                    </div>
                    
                    </header>
        
                <div class="post-corpo">
                    <a href="#"><img src="/assets/img/img07-perfil-membro.png" alt="Foto marcada" class="post-imagem"></a>
                </div>
                
            </article>

            <article class="post-marcado">
        
                <header class="post-header">
                    
                    <a href="#" class="post-link-perfil">
                        <img src="/assets/img/img08-perfil-lider.png" alt="foto perfil" class="post-avatar">
                    </a>
        
                    <div class="post-info-usuario">
                        <a href="#" class="post-nome-usuario">Rodolfo</a>
                        <p class="post-localizacao-usuario">Rio de Janeiro</p>
                    </div>
                    
                    </header>
        
                <div class="post-corpo">
                    <a href="#"><img src="/assets/img/img05-perfil-lider.png" alt="Foto marcada" class="post-imagem"></a>
                </div>
                
            </article>
        
        </div>




       </div>
                       
                  
                    
    </div>
    
</body>
</html>