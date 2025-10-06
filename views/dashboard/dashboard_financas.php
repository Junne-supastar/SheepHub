<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SheepHub</title>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<<<<<<< HEAD:views/dashboard_financas.php
    <link rel="stylesheet" href="/SheepHub/views/assets/css/dashboard-finanças02.css">
    <script src="/SheepHub/views/assets/js/dashboard-finanças02.js" defer></script>
=======
    <link rel="stylesheet" href="../assets/css/dashboard-finanças02.css">
    <script src="../assets/js/dashboard-finanças02.js" defer></script>
>>>>>>> 3061752 (organização dos arquivos):views/dashboard/dashboard_financas.php
</head>
<body>
    <div class="container-principal">
        <?php include __DIR__ . '/../includes/sidebar.php'; ?>

        <div id="fundo-overlay" class="hidden"></div>

        
            
            <main class="content">
                <h2>Bem vindo, Augustus!</h2>
                <h1>Dashboard</h1>

                <div class="grid-principal">
                    <div class="coluna-esquerda">
                        <div class="grid-estatisticas">
                            <div class="cartao-estatistica">
                                <div class="icone-cartao"><img src="../assets/img/icone-mao-dashboard-financas.svg" alt=""></div>
                                <div class="desc-card-estatistica">
                                    <p>Renda Total</p>
                                    <p class="valor-cartao">R$5.037</p>
                                </div>
                            </div> 

                            <div class="cartao-estatistica">
                                <div class="icone-cartao"><img src="../assets/img/icone-sacodollar-dashboard-financas.svg" alt=""></div>
                                <div class="desc-card-estatistica">
                                    <p class="substitulo-valor-cartao">Despesas</p>
                                    <p class="valor-cartao">R$2.141</p>
                                </div>
                            </div>

                            <div class="cartao-estatistica">
                                <div class="icone-cartao"><img src="../assets/img/icone-porco-dashboard-financas.svg" alt=""></div>
                                <div class="desc-card-estatistica">
                                    <p>Economia</p>
                                    <p class="valor-cartao">R$7.233</p>
                                </div>
                            </div>
                        </div>

                        <div class="cartao">
                            <div class="cabecalho-cartao">
                                <h3>Crescimento Total</h3>
                                <select class="seletor-periodo">
                                    <option>Este Mês</option>
                                    <option>Este Trimestre</option>
                                    <option>Este Ano</option>
                                </select>
                            </div>
                            <div id="grafico-crescimento"></div>
                        </div>
                    </div>

                    <div class="coluna-direita">
                        <div class="cont-progresso">
                            <div class="progresso-item" id="progresso-item-01">
                                <div class="icone-progresso um"><img src="../assets/img/icone-martelo-dashboard-financas.svg" alt=""></div>
                                <div class="card-geral-progresso">
                                    <div class="card-progresso" id="card-progresso01">
                                        <p><strong>Melhora do templo</strong></p>
                                        <p><strong>75%</strong></p>
                                    </div>
                                    <div class="barra-progresso" id="barra-progresso01"><div class="preenchimento-progresso um"></div></div>
                                </div>
                            </div>

                            <div class="progresso-item" id="progresso-item-02">
                                <div class="icone-progresso dois"><img src="../assets/img/icone-aviao-dashboard-financas.svg" alt=""></div>
                                <div class="card-geral-progresso">
                                    <div class="card-progresso" id="card-progresso02">
                                        <p><strong>Viagem missionária</strong></p>
                                        <p><strong>50%</strong></p>
                                    </div>
                                    <div class="barra-progresso" id="barra-progresso02"><div class="preenchimento-progresso dois"></div></div>
                                </div>
                            </div>
                        </div>

                        <div class="cartao" id="card-atividade">
                            <div class="cabecalho-cartao">
                                <h3>Atividade</h3>
                            </div>
                            <div id="grafico-atividade"></div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
