<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// se você estiver usando sessão para usuário logado
require __DIR__ . '/../../controllers/MetaController.php';


// Inicializa o controller
$controller = new MetaController();

// Pega todas as metas do usuário logado
// Se você tiver o id do usuário logado em $_SESSION['id_usuario'], por exemplo:

$metas = $controller->listar(); // lista todas as metas desse usuário
// Separar metas pendentes e concluídas
$metas_pendentes = [];
$metas_concluidas = [];

if (!empty($metas)) {
    foreach ($metas as $meta) {
        if ($meta['id_status'] == 4) { // 4 = concluída
            $metas_concluidas[] = $meta;
        } else { // pendente ou outra
            $metas_pendentes[] = $meta;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SheepHub</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/criarMeta.css">
</head>

<body>
    <!-- <?php include __DIR__ . '/../includes/sidebar.php'; ?> -->
    
    <main>
        <a id="voltar" href=""><i class='bxr  bxs-arrow-left'></i></a>
        <div class="titulo">
            <h3>Metas em andamento</h3>
            <a class="add" href="../../rotas/router_metas.php?action=cadastrar"><i class='bx bxs-plus'></i></a>
        </div>

        <section class="andamento">
            <?php if (!empty($metas_pendentes)): ?>
                <?php foreach ($metas_pendentes as $meta): ?>
                    <div class="linha">
                        <div class="progresso-card">
                            <div class="icone">
                                <?php if ($meta['icone'] == 'aviao'): ?>
                                    <i class='bxr icone-amarelo bxs-plane-alt'></i>
                                <?php elseif ($meta['icone'] == 'martelo'): ?>
                                    <i class='bxr icone-amarelo bxs-blocks'></i>
                                <?php elseif ($meta['icone'] == 'dinheiro'): ?>
                                    <i class='bxr icone-amarelo bxs-currency-note'></i>
                                <?php elseif ($meta['icone'] == 'livro'): ?>
                                    <i class='bxr icone-amarelo bxs-book-alt'></i>
                                <?php endif; ?>
                            </div>

                            <div class="detalhes-meta">
                                <p class="nome-meta"><?= htmlspecialchars($meta['nome_meta']) ?></p>
                                <div class="barra-progresso">
                                    <?php $progresso = $meta['objetivo'] > 0 ? round(($meta['investimento'] / $meta['objetivo']) * 100) : 0; ?>
                                    <progress value="<?= $progresso ?>" max="100"></progress>
                                    <p class="percentual-meta"><?= $progresso ?>%</p>
                                </div>
                            </div>
                        </div>

                        <div class="acoes">
                             <a href="../../rotas/router_metas.php?action=concluir&id=<?=$meta['id_meta']?>">
                                <i class='bxr acao seleciona bxs-check'></i> 
                            </a>
                            <button class="acao menu-btn"><i class='bx acao bxs-dots-vertical-rounded'></i></button>
                            <div class="menu-modal">
                               <ul>
                                    <a href="<?php echo '../../rotas/router_metas.php?action=editar&id='. $meta['id_meta']; ?>" style="text-decoration: none;">
                                    <li class="editar"><i class='bx bxs-edit'></i> Editar</li>
                                    </a>
                                    <a href="<?php echo '../../rotas/router_metas.php?action=ver&id='. $meta['id_meta']; ?>" style="text-decoration: none;">
                                        <li class="ver"><i class='bx bxs-book'></i> Ver detalhes</li>
                                    </a>
                                    <a href="<?php echo '../../rotas/router_metas.php?action=excluir&id='. $meta['id_meta']; ?>" style="text-decoration: none;" onclick="return confirm('Tem certeza que deseja excluir esta meta?')">
                                        <li class="remover"><i class='bx bxs-trash'></i> Excluir</li>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>  
                <p>Nenhuma meta pendente cadastrada.</p>
            <?php endif; ?>
        </section>

        <h3>Metas concluídas</h3>
        <section class="concluidas">
            <?php if (!empty($metas_concluidas)): ?>
                <?php foreach ($metas_concluidas as $meta): ?>
                    <div class="linha">
                        <div class="progresso-card">
                            <div class="icone">
                                <?php if ($meta['icone'] == 'aviao'): ?>
                                    <i class='bxr icone-amarelo bxs-plane-alt'></i>
                                <?php elseif ($meta['icone'] == 'martelo'): ?>
                                    <i class='bxr icone-amarelo bxs-blocks'></i>
                                <?php elseif ($meta['icone'] == 'dinheiro'): ?>
                                    <i class='bxr icone-amarelo bxs-currency-note'></i>
                                <?php elseif ($meta['icone'] == 'livro'): ?>
                                    <i class='bxr icone-amarelo bxs-book-alt'></i>
                                <?php endif; ?>
                            </div>

                            <div class="detalhes-meta">
                                <p class="nome-meta"><?= htmlspecialchars($meta['nome_meta']) ?></p>
                                <div class="barra-progresso">
                                    <?php
                                        $progresso = 0;

                                        if ($meta['objetivo'] > 0) {
                                            $progresso = round(($meta['investimento'] / $meta['objetivo']) * 100);
                                        }

                                        // se a meta for concluída (id_status == 4), força o progresso a 100%
                                        if (isset($meta['id_status']) && $meta['id_status'] == 4) {
                                            $progresso = 100;
                                        }

                                        // impede que passe de 100%
                                        if ($progresso > 100) {
                                            $progresso = 100;
                                        }
                                    ?>
                                    <progress value="<?= $progresso ?>" max="100"></progress>
                                    <p class="percentual-meta"><?= $progresso ?>%</p>
                                </div>
                            </div>
                        </div>
                        <div class="acoes">
                            <i class='bxr acao seleciona bxs-check' style="color: green;"></i>
                            <button class="acao menu-btn"><i class='bx acao bxs-dots-vertical-rounded'></i></button>
                            <div class="menu-modal">
                               <ul>
                                    <a href="<?php echo '../../rotas/router_metas.php?action=editar&id='. $meta['id_meta']; ?>" style="text-decoration: none;">
                                    <li class="editar"><i class='bx bxs-edit'></i> Editar</li>
                                    </a>
                                    <a href="<?php echo '../../rotas/router_metas.php?action=ver&id='. $meta['id_meta']; ?>" style="text-decoration: none;">
                                        <li class="ver"><i class='bx bxs-book'></i> Ver detalhes</li>
                                    </a>
                                    <a href="<?php echo '../../rotas/router_metas.php?action=excluir&id='. $meta['id_meta']; ?>" style="text-decoration: none;" onclick="return confirm('Tem certeza que deseja excluir esta meta?')">
                                        <li class="remover"><i class='bx bxs-trash'></i> Excluir</li>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma meta concluída.</p>
            <?php endif; ?>
        </section>

    </main>

    <script src="../assets/js/criarMeta.js"></script>
</body>

</html>
