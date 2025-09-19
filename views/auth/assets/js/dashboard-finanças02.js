document.addEventListener('DOMContentLoaded', function () {
        
   
    const botaoMenu = document.getElementById('botao-menu');
    const menuLateral = document.getElementById('menu-lateral');
    const fundoOverlay = document.getElementById('fundo-overlay');

    function alternarMenuMobile() {
        menuLateral.classList.toggle('aberto');
        fundoOverlay.classList.toggle('hidden');
    }

    botaoMenu.addEventListener('click', alternarMenuMobile);
    fundoOverlay.addEventListener('click', alternarMenuMobile);
    

    var opcoesGraficoCrescimento = {
        series: [{
            name: 'Investimento', data: [44, 55, 41, 67, 22, 43, 21, 49, 23, 43, 33, 52]
        }, {
            name: 'Perda', data: [13, 23, 20, 8, 13, 27, 33, 12, 15, 27, 18, 15]
        }, {
            name: 'Lucro', data: [11, 17, 15, 15, 21, 14, 15, 13, 21, 14, 25, 13]
        }],
        chart: {
            type: 'bar', height: 350, stacked: true, toolbar: { show: false },
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        },
        legend: { position: 'top' },
        colors: ['#166280', '#3F9CC0', '#7DCCEB'],
    };

    var graficoCrescimento = new ApexCharts(document.querySelector("#grafico-crescimento"), opcoesGraficoCrescimento);
    graficoCrescimento.render();
    
    var opcoesGraficoAtividade = {
        series: [25, 10, 15, 60], 
        labels: ['Contas', 'Festividades', 'Doação abrigo', 'Missões'], 
        chart: {
            type: 'donut',
            height: 280 
        },
        colors: ['#9EB3C2', '#BCC1C5', '#A7D8E8', '#4682B4'], 
        legend: {
            position: 'bottom', 
            horizontalAlign: 'center', 
            width: 300,
            fontSize: '14px',
            markers: {
                radius: 12,
            },
            itemMargin: {
                horizontal: 10,
                vertical: 5 
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%'
                }
            }
        },
        dataLabels: {
            enabled: false
        },
    };

    var graficoAtividade = new ApexCharts(document.querySelector("#grafico-atividade"), opcoesGraficoAtividade);
    graficoAtividade.render();
});