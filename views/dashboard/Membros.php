

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SheepHub</title>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="../assets/js/dashboard.js" defer></script>
</head>
<body>

    <div class="container-principal ">
        <?php include __DIR__ . '/../includes/sidebar.php'; ?>
            
            <main class="content">
                <h2>Bem vindo, Augustus!</h2>
                <h1>Dashboard</h1>

                <div class="grid-principal">
                    <div class="coluna-esquerda">

                        <div class="grid-estatisticas">

                            <div class="cartao-estatistica">
                                <div class="icone-cartao"><i class='bx bxs-group card-icon'></i></div>
                                <div class="desc-card-estatistica">
                                    <p>Total de membros</p>
                                    <p class="valor-cartao">100</p>
                                </div>
                            </div> 

                            <div class="cartao-estatistica">
                                <div class="icone-cartao"><i class='bx bxs-chevrons-up card-icon'></i></div>
                                <div class="desc-card-estatistica">
                                    <p class="substitulo-valor-cartao
                                    ">Taxa de crescimento</p>
                                    <p class="valor-cartao">5% ao ano</p>
                                </div>
                            </div>

                             <div class="cartao-estatistica">
                                <div class="icone-cartao"><i class='bx bx-child card-icon'></i></div>
                                <div class="desc-card-estatistica">
                                    <p>Juventude</p>
                                    <p class="valor-cartao">46</p>
                                </div>
                            </div>

                        </div> <!--grid estatísticas-->

                    </div> <!--coluna esquerda-->

                    

                     <div class="coluna-direita">
                        <div class="cont-progresso">
                            <div class="progresso-item" id="progresso-item-01">

                                <div class="icone-progresso um"><i class='bx bxs-briefcase-alt card-icon'></i></div>

                                <div class="card-geral-progresso">
                                    <div class="card-progresso" id="card-progresso01">
                                        <p><strong>Membros ativos</strong></p>
                                        <p><strong>75%</strong></p>
                                    </div>

                                    <div class="barra-progresso" id="barra-progresso01"><div class="preenchimento-progresso um"></div></div>
                                </div>
                            </div> <!--progresso-item-01-->

                            <div class="progresso-item" id="progresso-item-02">

                                <div class="icone-progresso dois"><i class='bx bxs-coin card-icon'></i></div>

                                <div class="card-geral-progresso">
                                    <div class="card-progresso" id="card-progresso02">
                                        <p><strong>Dizimistas</strong></p>
                                        <p><strong>50%</strong></p>
                                    </div>
                                    <div class="barra-progresso" id="barra-progresso02"><div class="preenchimento-progresso dois"></div></div>
                                </div>
                            </div> <!--progresso-item-02-->
                        </div> <!--cont-progresso-->

                    </div> <!--coluna direita-->

                        <div class="tabela-container">
                            <table class="tabela-membros">
                                <thead>
                                    <tr>
                                        <th class="col-foto">Foto</th>
                                        <th>Nome</th>
                                        <th>Idade</th>
                                        <th>Endereço</th>
                                        <th>Departamento</th>
                                        <th class="col-controle">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="https://placehold.co/40x40" alt="foto" class="foto-usu"></td>
                                        <td>Fernanda Leal</td>
                                        <td>16</td>
                                        <td>R. Curitiba 123</td>
                                        <td>Pregação</td>
                                        <td class="acoes">
                                            <a href="" class="botao-controle read"><i class='bx bxs-spreadsheet'></i></a>
                                            <a href="" class="botao-controle"><i class='bx bxs-edit'></i></a>
                                            <a href="" class="botao-controle remove"><i class='bx bxs-trash-alt'></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="https://placehold.co/40x40" alt="foto" class="foto-usu"></td>
                                        <td>Rafael Augusto</td>
                                        <td>17</td>
                                        <td>R. Curitiba 123</td>
                                        <td>Teatro</td>
                                         <td class="acoes">
                                            <a href="" class="botao-controle read"><i class='bx bxs-spreadsheet'></i></a>
                                            <a href="" class="botao-controle"><i class='bx bxs-edit'></i></a>
                                            <a href="" class="botao-controle remove"><i class='bx bxs-trash-alt'></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="https://placehold.co/40x40" alt="foto" class="foto-usu"></td>
                                        <td>Julianne Parga</td>
                                        <td>17</td>
                                        <td>R. Curitiba 123</td>
                                        <td>Dança</td>
                                         <td class="acoes">
                                            <a href="" class="botao-controle read"><i class='bx bxs-spreadsheet'></i></a>
                                            <a href="" class="botao-controle"><i class='bx bxs-edit'></i></a>
                                            <a href="" class="botao-controle remove"><i class='bx bxs-trash-alt'></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="https://placehold.co/40x40" alt="foto" class="foto-usu"></td>
                                        <td>Breno Pessôa</td>
                                        <td>21</td>
                                        <td>R. Curitiba 123</td>
                                        <td>Louvor</td>
                                         <td class="acoes">
                                            <a href="" class="botao-controle read"><i class='bx bxs-spreadsheet'></i></a>
                                            <a href="" class="botao-controle"><i class='bx bxs-edit'></i></a>
                                            <a href="" class="botao-controle remove"><i class='bx bxs-trash-alt'></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="https://placehold.co/40x40" alt="foto" class="foto-usu"></td>
                                        <td>Davis de Freitas</td>
                                        <td>28</td>
                                        <td>R. Curitiba 123</td>
                                        <td>Coral</td>
                                         <td class="acoes">
                                            <a href="" class="botao-controle read"><i class='bx bxs-spreadsheet'></i></a>
                                            <a href="" class="botao-controle"><i class='bx bxs-edit'></i></a>
                                            <a href="" class="botao-controle remove"><i class='bx bxs-trash-alt'></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!--tabela-container-->
            </main>
        </div>
    </div>


</body>
</html>