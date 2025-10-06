<?php
  if (session_status() === PHP_SESSION_NONE) session_start();
    require_once __DIR__ . '/../controllers/UsuarioController.php';
    require_once __DIR__ . '/../controllers/UsuarioInstituicaoController.php';
    require_once __DIR__ . '/../config/niveis_usu.php';

    $ctrl = new UsuarioController();
    $ctrlInst = new UsuarioInstituicaoController();
    $nivel = $_GET['tipo'] ?? 'usuario';

    
    // Mudar status se solicitado// No topo do listar_usuario.php
    if (isset($_GET['set_status'])) {
        $novoStatus = (int) $_GET['set_status'];
        
        if (isset($_GET['id'])) { // usuário
            $idusuario = (int) $_GET['id'];
            $ctrl->atualizarStatus($idusuario, $novoStatus);
        } elseif (isset($_GET['id_instituicao'])) { // instituição
            $idInstituicao = (int) $_GET['id_instituicao'];
            $ctrlInst->atualizarStatus($idInstituicao, $novoStatus);
        }
        
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        header('Location: listar_usuario.php?tipo=' . $nivel . '&pagina=' . $paginaAtual);
        exit;
}




    // Paginations
    $quantidade = 5;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $inicio = $quantidade * $pagina - $quantidade;

    $usuario = $ctrl->index($inicio, $quantidade);
    $instituicoes = $ctrlInst->index($inicio, $quantidade);
    $totalRegistros = $ctrl->contar();
    $totalPaginas = ceil($totalRegistros / $quantidade);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="../assets/css/dashboardcrud.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../assets/js/dashboard.js" defer></script>
</head>

<body>
    <div class="container-principal">
        <?php include __DIR__ . '/../includes/sidebar.php'; ?>
            <main class="content">
                <h2>Bem vindo, Augustus!</h2>
                <h1>Dashboard</h1>

                        <div class="crud-top-bar">
                            <label for="tipo" class="tipo-label">Listas:</label>
                            <select name="tipo" id="tipo">
                                <option value="usuario" <?= $nivel === 'usuario' ? 'selected' : '' ?>>Usuário</option>
                                <option value="instituicao" <?= $nivel === 'instituicao' ? 'selected' : '' ?>>Instituição</option>
                            </select>

                            <div class="botao-cadastrar">
                                <a href="auth/escolha.php" class="btn-cadastrar">Cadastrar</a>
                            </div>
                    </div>



                    <div class="tabela-container" id="tabela-usuarios-container">
                        <table class="tabela-membros">
                            <thead>
                                <tr>
                                    <!-- <th class="col-foto">Foto</th> -->
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Nivel</th>

                                    <th>Status</th>
                                    <th class="col-controle">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($usuario as $user): ?>
                                <tr>
                                    <!-- <td><img src="https://placehold.co/40x40" alt="foto" class="foto-usu"></td> -->
                                    <td>
                                        <?= $user['nome'] ?>
                                    </td>
                                    <td>
                                        <?= $user['email'] ?>
                                    </td>
                                    <td>
                                        <?= $user['nivel'] ?>
                                    </td>
                                    <td>
                                        <?= $user['nome_status'] ?>
                                    </td>
                                    <div class="botoes-acao">
                                        <td>
                                            <!-- Ativar -->
                                          <a href="listar_usuario.php?set_status=1&id=<?= $user['idusuario'] ?>&tipo=<?= $nivel ?>&pagina=<?= $pagina ?>"
                                        class="status-btn <?= $user['id_status'] == 1 ? 'btn-ativo' : 'btn-inativo' ?>">Ativo</a>

                                        <a href="listar_usuario.php?set_status=2&id=<?= $user['idusuario'] ?>&tipo=<?= $nivel ?>&pagina=<?= $pagina ?>"
                                        class="status-btn <?= $user['id_status'] == 2 ? 'btn-ativo' : 'btn-inativo' ?>">Inativo</a>
                                        </td>
                                    </div>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!--tabela-container-->

                    <div class="tabela-container" id="tabela-instituicoes-container">
                        <table class="tabela-membros">
                            <thead>
                                <tr>
                                    <!-- <th class="col-foto">Foto</th> -->
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>CNPJ</th>
                                    
                                    <th>Status</th>
                                    <th class="col-controle">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($instituicoes as $i): ?>
                                <tr>
                                    <!-- <td><img src="https://placehold.co/40x40" alt="foto" class="foto-usu"></td> -->
                                    <td>
                                        <?= $i['nome_instituicao'] ?>
                                    </td>
                                    <td>
                                        <?= $i['email_instituicao'] ?>
                                    </td>
                                    <td>
                                        <?= $i['cnpj'] ?>
                                    </td>
                                    
                                    <td>
                                        <?= $i['nome_status']?></td>
                                    </td>
                                    <div class="botoes-acao">
                                         <td>
                                       <a href="listar_usuario.php?set_status=1&id_instituicao=<?= $i['idusuario_instituicao'] ?>&tipo=<?= $nivel ?>&pagina=<?= $pagina ?>"
                                       class="status-btn <?= $i['id_status'] == 1 ? 'btn-ativo' : 'btn-inativo' ?>">Ativo</a>

                                       <a href="listar_usuario.php?set_status=2&id_instituicao=<?= $i['idusuario_instituicao'] ?>&tipo=<?= $nivel ?>&pagina=<?= $pagina ?>"
                                       class="status-btn <?= $i['id_status'] == 2 ? 'btn-ativo' : 'btn-inativo' ?>">Inativo</a>
                                        </td>
                                    </div>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div> <!--tabela-container-->

                    <div id="bottom" class="row">
    <div class="col-md-12">
    <?php
    $anterior = max(1, $pagina - 1);
    $proxima  = min($totalPaginas, $pagina + 1);

    echo "<ul class='paginacao'>";

    // Primeira página
    echo "<li><a href='listar_usuario.php?tipo=$nivel&pagina=1'>Primeira</a></li>";

    // Página anterior
    echo "<li><a href='listar_usuario.php?tipo=$nivel&pagina=$anterior'>&laquo; Anterior</a></li>";

    // Página atual
    echo "<li class='ativo'><a href='listar_usuario.php?tipo=$nivel&pagina=$pagina'>$pagina</a></li>";

    // Próximas páginas (até 2 depois da atual)
    for ($i = $pagina + 1; $i < $pagina + 3 && $i <= $totalPaginas; $i++) {
        echo "<li><a href='listar_usuario.php?tipo=$nivel&pagina=$i'>$i</a></li>";
    }

    // Próxima página
    echo "<li><a href='listar_usuario.php?tipo=$nivel&pagina=$proxima'>Próxima &raquo;</a></li>";

    // Última página
    echo "<li><a href='listar_usuario.php?tipo=$nivel&pagina=$totalPaginas'>Última</a></li>";

    echo "</ul>";
    ?>
</div>
</div>
            </main>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const selectTipo = document.getElementById('tipo');
                    const tabelaUsuarios = document.getElementById('tabela-usuarios-container');
                    const tabelaInstituicoes = document.getElementById('tabela-instituicoes-container');

                    // Função para mostrar a tabela correta
                    function mostrarTabela() {
                        const valorSelecionado = selectTipo.value;

                        // Esconde ambas as tabelas
                        tabelaUsuarios.style.display = 'none';
                        tabelaInstituicoes.style.display = 'none';

                        // Mostra a tabela baseada na seleção
                        if (valorSelecionado === 'usuario') {
                            tabelaUsuarios.style.display = 'block';
                        } else if (valorSelecionado === 'instituicao') {
                            tabelaInstituicoes.style.display = 'block';
                        }
                    }

                    // Adiciona o ouvinte de evento para quando o valor do select muda
                    selectTipo.addEventListener('change', mostrarTabela);

                    // Chama a função ao carregar a página para definir o estado inicial
                    mostrarTabela();
                });

            </script>
</body>

</html>