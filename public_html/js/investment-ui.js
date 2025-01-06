document.addEventListener('DOMContentLoaded', function() {
    const analyzer = new InvestmentAnalyzer();
    
    window.calcularRentabilidade = function() {
        // Obter valores dos inputs
        const valorInicial = parseFloat(document.getElementById('valorInicial').value);
        const aporteMensal = parseFloat(document.getElementById('aporteMensal').value);
        const prazo = parseInt(document.getElementById('prazo').value);
        const tipoRendimento = document.getElementById('tipoRendimento').value;
        const taxaFixa = parseFloat(document.getElementById('taxaFixa').value) / 100;
        const taxaCDI = parseFloat(document.getElementById('taxaCDI').value) / 100;
        const percentualCDIComImposto = parseFloat(document.getElementById('percentualCDIComImposto').value) / 100;
        const inflacao = parseFloat(document.getElementById('inflacao').value) / 100;
        
        if (!validateInputs(valorInicial, aporteMensal, prazo, inflacao)) {
            return;
        }

        let taxaMensal = tipoRendimento === 'fixa' ? taxaFixa : (taxaCDI / 12) * percentualCDIComImposto;

        const results = analyzer.calculateInvestmentResults({
            valorInicial,
            aporteMensal,
            prazo,
            taxaMensal,
            inflacao,
            perfilRisco: 5
        });

        const report = analyzer.generateReport(results);

        displayBasicResults(results);
        displayDetailedAnalysis(results, report);
        updateCharts(results);

        const sensitivityResults = analyzer.generateSensitivityAnalysis({
            valorInicial,
            aporteMensal,
            prazo,
            taxaMensal,
            inflacao,
            perfilRisco: 5
        });

        displaySensitivityAnalysis(sensitivityResults);

        // Atualizar cenários
        updateScenarios(results);
    };

    function validateInputs(valorInicial, aporteMensal, prazo, inflacao) {
        if (isNaN(valorInicial) || isNaN(aporteMensal) || isNaN(prazo) || isNaN(inflacao)) {
            alert("Por favor, preencha todos os campos obrigatórios com valores válidos.");
            return false;
        }
        return true;
    }

    function displayBasicResults(results) {
        const formatCurrency = value => value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        const formatPercent = value => `${value.toFixed(2)}%`;

        document.getElementById('resultValorInicial').textContent = formatCurrency(results.investimentoTotal);
        document.getElementById('resultValorFinal').textContent = formatCurrency(results.valorFinal);
        document.getElementById('resultGanhoTotal').textContent = formatCurrency(results.ganhoTotal);
        document.getElementById('resultInflacaoAcumulada').textContent = formatPercent(results.inflacaoAcumulada * 100);
        document.getElementById('resultValorFinalAjustado').textContent = formatCurrency(results.valorFinalAjustado);
        
        document.getElementById('results').style.display = 'block';
    }

    function displayDetailedAnalysis(results, report) {
        let analysisSection = document.getElementById('detailed-analysis');
        if (!analysisSection) {
            analysisSection = document.createElement('div');
            analysisSection.id = 'detailed-analysis';
            analysisSection.className = 'results';
            document.getElementById('resultadosTab').appendChild(analysisSection);
        }

        analysisSection.innerHTML = `
            <h3>${report.resumo.title}</h3>
            <pre>${report.resumo.content}</pre>
            
            <h3>${report.analiseRisco.title}</h3>
            <pre>${report.analiseRisco.content}</pre>
            
            <h3>${report.recomendacoes.title}</h3>
            <ul>
                ${report.recomendacoes.content.split('\n').map(rec => `<li>${rec}</li>`).join('')}
            </ul>
        `;
    }

    function updateCharts(results) {
        updatePatrimonioChart(results.valoresMensais);
        updateComposicaoChart(results);
        updateRiskAnalysisChart(results);
    }

    function updatePatrimonioChart(valoresMensais) {
        const ctx = document.getElementById('chartSimulacao').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: Array.from({ length: valoresMensais.length }, (_, i) => `Mês ${i}`),
                datasets: [{
                    label: 'Patrimônio Total',
                    data: valoresMensais,
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Evolução do Patrimônio'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `R$ ${context.parsed.y.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return `R$ ${value.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;
                            }
                        }
                    }
                }
            }
        });
    }

    function updateComposicaoChart(results) {
        const ctx = document.getElementById('chartComposicao').getContext('2d');
        
        const investimentoInicial = results.investimentoTotal;
        const ganhoTotal = results.ganhoTotal;
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Investimento Total', 'Rendimentos'],
                datasets: [{
                    data: [investimentoInicial, ganhoTotal],
                    backgroundColor: [
                        'rgba(46, 204, 113, 0.8)',
                        'rgba(52, 152, 219, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Composição do Patrimônio Final'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value * 100) / total).toFixed(2);
                                return `${context.label}: R$ ${value.toLocaleString('pt-BR', { minimumFractionDigits: 2 })} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    function updateRiskAnalysisChart(results) {
        const ctx = document.getElementById('chartRisco').getContext('2d');
        
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Volatilidade', 'Retorno', 'Risco/Retorno', 'Proteção Inflação', 'Liquidez'],
                datasets: [{
                    label: 'Perfil do Investimento',
                    data: [
                        results.volatilidade * 10,
                        results.rentabilidadeReal / 10,
                        results.sharpeRatio * 2,
                        (results.rentabilidadeReal > results.inflacaoAcumulada ? 8 : 4),
                        7
                    ],
                    backgroundColor: 'rgba(52, 152, 219, 0.2)',
                    borderColor: 'rgba(52, 152, 219, 1)',
                    pointBackgroundColor: 'rgba(52, 152, 219, 1)'
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 10,
                        ticks: {
                            stepSize: 2
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Análise de Risco e Retorno'
                    }
                }
            }
        });
    }

    function displaySensitivityAnalysis(sensitivityResults) {
        const ctx = document.getElementById('chartSensibilidade').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: sensitivityResults.taxaJuros.map(r => `${r.variacao}%`),
                datasets: [
                    {
                        label: 'Sensibilidade à Taxa de Juros',
                        data: sensitivityResults.taxaJuros.map(r => r.valorFinal),
                        borderColor: 'rgba(52, 152, 219, 1)',
                        fill: false
                    },
                    {
                        label: 'Sensibilidade ao Aporte Mensal',
                        data: sensitivityResults.aporteMensal.map(r => r.valorFinal),
                        borderColor: 'rgba(46, 204, 113, 1)',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Análise de Sensibilidade'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `R$ ${context.parsed.y.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return `R$ ${value.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;
                            }
                        }
                    }
                }
            }
        });
    }

    function updateScenarios(results) {
        const formatCurrency = value => value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        const formatPercent = value => `${value.toFixed(2)}%`;

        // Cenário Conservador (-20% na rentabilidade)
        const conservadorContent = document.querySelector('.scenario-card:nth-child(1) .scenario-content');
        const conservadorResult = results.valorFinal * 0.8;
        conservadorContent.innerHTML = `
            <p>Valor Final: ${formatCurrency(conservadorResult)}</p>
            <p>Rendimento: ${formatPercent((conservadorResult/results.investimentoTotal - 1) * 100)}</p>
        `;

        // Cenário Base
        const baseContent = document.querySelector('.scenario-card:nth-child(2) .scenario-content');
        baseContent.innerHTML = `
            <p>Valor Final: ${formatCurrency(results.valorFinal)}</p>
            <p>Rendimento: ${formatPercent((results.valorFinal/results.investimentoTotal - 1) * 100)}</p>
        `;

        // Cenário Otimista (+20% na rentabilidade)
        const otimistaContent = document.querySelector('.scenario-card:nth-child(3) .scenario-content');
        const otimistaResult = results.valorFinal * 1.2;
        otimistaContent.innerHTML = `
            <p>Valor Final: ${formatCurrency(otimistaResult)}</p>
            <p>Rendimento: ${formatPercent((otimistaResult/results.investimentoTotal - 1) * 100)}</p>
        `;
    }
});