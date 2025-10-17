<?php
require __DIR__ . '/../../controllers/MetaController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controller = new MetaController();

// 2. Lógica de GET (Cadastro/Editar/Ver) - Inicialização das variáveis
$acao = $_GET['action'] ?? 'cadastrar';
$id = $_GET['id'] ?? null;
$meta = [
    'nome_meta' => '',
    'icone' => '',
    'objetivo' => 0.00,
    'investimento' => 0.00
];

if ($id) {
    $meta_encontrada = $controller->buscarMetaPorId($id);
    if ($meta_encontrada) {
        $meta = $meta_encontrada;
    }
}

// Inicializa as variáveis de objetivo e investimento para o escopo
$objetivo = 0.00;
$investimento = 0.00;

// 1. Lógica de POST (Criação/Edição) - DEVE ESTAR AQUI PARA PROCESSAR ANTES DE RENDERIZAR
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_meta'] ?? null;
    $acaoForm = $_POST['acao'] ?? 'cadastrar';

    // --- LIMPEZA E CONVERSÃO DOS VALORES MONETÁRIOS ---
    $objetivoStr = $_POST['objetivo'] ?? '0';
    $investimentoStr = $_POST['investimento'] ?? '0';

    // Remove tudo que não é número, vírgula ou ponto (o ponto para garantir que o R$ não interfira)
    $objetivoStr = preg_replace('/[^0-9,.]/', '', $objetivoStr);
    $investimentoStr = preg_replace('/[^0-9,.]/', '', $investimentoStr);

    // Converte vírgula para ponto para que o floatval funcione corretamente (R$ 1.000,50 -> 1000.50)
    $objetivo = floatval(str_replace(',', '.', $objetivoStr));
    $investimento = floatval(str_replace(',', '.', $investimentoStr));

    // Validação obrigatória
    if ($objetivo < $investimento) {
        $_SESSION['erro'] = "O valor da meta deve ser maior ou igual ao investimento (R$ " . number_format($investimento, 2, ',', '.') . ")";
        // Redireciona de volta para a tela de cadastro/edição
        header("Location: cadastroMeta.php?action=$acao&id=$id");
        exit;
    }
    // ----------------------------------------------------
    
    // As variáveis $objetivo e $investimento agora são float e seguras para o banco.
    $nome_meta = $_POST['nome_meta'];
    $icone = $_POST['icone'];

    if ($acaoForm === 'editar' && $id) {
        // Chamada AGORA com os 4 parâmetros limpos
        $controller->editarMeta($id, $nome_meta, $icone, $objetivo, $investimento);
    } else {
        // Chamada AGORA com os 4 parâmetros limpos
        $controller->criarMeta($nome_meta, $icone, $objetivo, $investimento);
    }

    // Redireciona para a listagem principal após a operação
    header("Location: criarMeta.php");
    exit;
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
    <link rel="stylesheet" href="../assets/css/cadastroMeta.css">
</head>
<body>

<main class="conteudo">
    <a id="voltar" href="criarMeta.php"><i class='bxr bxs-arrow-left'></i></a>
    <div class="titulo">
        <h3><?= $acao === 'editar' ? 'Editar Meta' : ($acao === 'ver' ? 'Visualizar Meta' : 'Cadastro de meta') ?></h3>
    </div>

    <form action="" method="POST">
    <input type="hidden" name="id_meta" value="<?= $id ?? '' ?>">
    <input type="hidden" name="acao" value="<?= $acao ?>">
        <!-- Nome da meta -->
        <div class="campo area1">
            <div class="input-com-icone">
            <span class="icone"> <i class='bx icon bxs-plus'></i>
        
        </span>
            <input type="text" id="nome_meta" name="nome_meta" placeholder="Digite o nome da meta"
                   value="<?= $meta['nome_meta'] ?? '' ?>"
                   <?= $acao === 'ver' ? 'readonly' : '' ?> required>
            </div>
        </div>

        <!-- Ícones -->
        <div class="campo area2">
            <p class="desc">Escolha um ícone</p>
            <section id="icones-campo">
                <div class="icones">
                    <?php
                        $icones = [
                            'aviao' => 'bxs-plane-alt',
                            'martelo' => 'bxs-blocks',
                            'dinheiro' => 'bxs-currency-note',
                            'livro' => 'bxs-book-alt'
                        ];

                        foreach ($icones as $key => $class) {
                            $checked = isset($meta['icone']) && $meta['icone'] === $key ? 'checked' : '';
                            $disabled = ($acao === 'ver') ? 'disabled' : '';
                            echo "<input type='radio' id='icone_{$key}' name='icone' value='{$key}' {$checked} {$disabled} required>";
                            echo "<label for='icone_{$key}' class='botao-icone'><i class='bx icon selecionaIcon {$class}'></i></label>";
                        }
                        ?>
                </div>
            </section>
        </div>

        <!-- Informações -->
        <p class="desc">Outras informações</p>
        <div class="informacoes">
            <div class="campo cards">
                <label class="card-label" for="objetivo">Objetivo</label>
                <input class="card-input" type="text" id="objetivo" name="objetivo" placeholder="R$100,00" min="0" step="0.01"
                       value="<?= isset($meta['objetivo']) ? number_format($meta['objetivo'], 2, ',', '.') : '0,00'; ?>"
                       <?= $acao === 'ver' ? 'readonly' : '' ?> required>
            </div>

            <div class="campo cards">
                <label class="card-label" for="investimento">Investimento</label>
                <input class="card-input" type="text" id="investimento" name="investimento" placeholder="R$50,00" min="0" step="0.01"
                       value="<?= isset($meta['investimento']) ? number_format($meta['investimento'], 2, ',', '.') : '0,00'; ?>"
                       <?= $acao === 'ver' ? 'readonly' : '' ?> required>
            </div>  
        </div>

        <?php if ($acao !== 'ver'): ?>
            <button type="submit" class="btn-salvar"><?= $acao === 'editar' ? 'Salvar Alterações' : 'Salvar' ?></button>
        <?php endif; ?>

    </form>
</main>

<script src="../assets/js/cadastroMeta.js"></script>
</body>
</html>
