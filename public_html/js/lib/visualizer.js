/**
 * Classe responsável pela visualização dos resultados
 */
class ResultVisualizer {
    constructor() {
        this.charts = {};
    }

    /**
     * Atualiza todas as visualizações
     */
    atualizarVisualizacoes(resultados) {
        this.limparGraficos();
        this.criarGraficoEvolucao(resultados);
        this.criarGraficoComparativo(resultados);
        this.criarGraficoRisco(resultados);
        this.criarGraficoCenarios(resultados);
        this.atualizarMetricas(resultados);
        this.mostrarRecomendacoes(resultados);
    }

    /**
     * Limpa gráficos existentes
     */
    limparGraficos() {
        Object.values(this.charts).forEach(chart => {
            if (chart) chart.destroy();
        });
        this.charts = {};
    }

    /**
     * Cria gráfico de evolução patrimonial
     */
    criarGraficoEvolucao(resultados) {
        const ctx = document.getElementById('graficoEvolucao').getContext('2d');
        const { evolucao } = resultados;
        const labels = Array.from({ length: evolucao.pgblBruto.length }, (_, i) => `Mês ${i}`);

        this.charts.evolucao = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'PGBL Bruto',
                        data: evolucao.pgblBruto,
                        borderColor: 'rgba(52, 152, 219, 1)',
                        fill: false
                    },
                    {
                        label: 'PGBL Líquido',
                        data: evolucao.pgblLiquido,
                        borderColor: 'rgba(52, 152, 219, 0.5)',
                        borderDash: [5, 5],
                        fill: false
                    },
                    {
                        label: 'CDB Bruto',
                        data: evolucao.cdbBruto,
                        borderColor: 'rgba(46, 204, 113, 1)',
                        fill: false
                    },
                    {
                        label: 'CDB Líquido',
                        data: evolucao.cdbLiquido,
                        borderColor: 'rgba(46, 204, 113, 0.5)',
                        borderDash: [5, 5],
                        fill: false
                    }
                ]
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
                                return context.dataset.label + ": " + 
                                    context.parsed.y.toLocaleString('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL'
                                    });
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL',
                                    maximumFractionDigits: 0
                                });
                            }
                        }
                    }
                }
            }
        });
    }

    /**
     * Cria gráfico de análise de risco
     */
    criarGraficoRisco(resultados) {
        const ctx = document.getElementById('graficoRisco').getContext('2d');
        const { metricas } = resultados;

        this.charts.risco = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Volatilidade', 'Sharpe', 'TIR', 'Risco/Retorno', 'Eficiência Fiscal'],
                datasets: [
                    {
                        label: 'PGBL',
                        data: [
                            metricas.risco.pgbl.volatilidade * 100,
                            metricas.risco.pgbl.sharpe * 10,
                            metricas.tir.pgbl * 100,
                            metricas.risco.pgbl.mediaRetornos / metricas.risco.pgbl.volatilidade * 10,
                            8 // Eficiência fiscal PGBL
                        ],
                        backgroundColor: 'rgba(52, 152, 219, 0.2)',
                        borderColor: 'rgba(52, 152, 219, 1)'
                    },
                    {
                        label: 'CDB',
                        data: [
                            metricas.risco.cdb.volatilidade * 100,
                            metricas.risco.cdb.sharpe * 10,
                            metricas.tir.cdb * 100,
                            metricas.risco.cdb.mediaRetornos / metricas.risco.cdb.volatilidade * 10,
                            6 // Eficiência fiscal CDB
                        ],
                        backgroundColor: 'rgba(46, 204, 113, 0.2)',
                        borderColor: 'rgba(46, 204, 113, 1)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Análise de Risco e Retorno'
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 10,
                        ticks: {
                            stepSize: 2
                        }
                    }
                }
            }
        });
    }

    /**
     * Cria gráfico de cenários
     */
    criarGraficoCenarios(resultados) {
        const ctx = document.getElementById('graficoCenarios').getContext('2d');
        const { cenarios } = resultados;

        // Calcular percentis dos cenários
        const percentis = {
            pgbl: this.calcularPercentis(cenarios.pgbl[cenarios.pgbl.length - 1]),
            cdb: this.calcularPercentis(cenarios.cdb[cenarios.cdb.length - 1])
        };

        this.charts.cenarios = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pessimista (10%)', 'Realista (50%)', 'Otimista (90%)'],
                datasets: [
                    {
                        label: 'PGBL',
                        data: [
                            percentis.pgbl.p10,
                            percentis.pgbl.p50,
                            percentis.pgbl.p90
                        ],
                        backgroundColor: 'rgba(52, 152, 219, 0.7)'
                    },
                    {
                        label: 'CDB',
                        data: [
                            percentis.cdb.p10,
                            percentis.cdb.p50,
                            percentis.cdb.p90
                        ],
                        backgroundColor: 'rgba(46, 204, 113, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Análise de Cenários'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ": " + 
                                    context.parsed.y.toLocaleString('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL'
                                    });
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL',
                                    maximumFractionDigits: 0
                                });
                            }
                        }
                    }
                }
            }
        });
    }

    /**
     * Atualiza métricas no DOM
     */
    atualizarMetricas(resultados) {
        const metricsContainer = document.getElementById('metricas');
        const { saldoFinal, metricas } = resultados;

        metricsContainer.innerHTML = `
            <div class="metric-grid">
                <div class="metric-card">
                    <div class="metric-value">${this.formatarMoeda(saldoFinal.pgblLiquido)}</div>
                    <div class="metric-label">PGBL Líquido Final</div>
                </div>
                <div class="metric-card">
                    <div class="metric-value">${this.formatarMoeda(saldoFinal.cdbLiquido)}</div>
                    <div class="metric-label">CDB Líquido Final</div>
                </div>
                <div class="metric-card">
                    <div class="metric-value">${this.formatarPercentual(metricas.tir.pgbl)}</div>
                    <div class="metric-label">TIR PGBL</div>
                </div>
                <div class="metric-card">
                    <div class="metric-value">${this.formatarPercentual(metricas.tir.cdb)}</div>
                    <div class="metric-label">TIR CDB</div>
                </div>
            </div>
        `;
    }

    /**
     * Mostra recomendações
     */
    mostrarRecomendacoes(resultados) {
        const recomendacoesContainer = document.getElementById('recomendacoes');
        const recomendacoes = this.gerarRecomendacoes(resultados);

        recomendacoesContainer.innerHTML = `
            <h4>Recomendações</h4>
            ${recomendacoes.map(rec => `
                <div class="recommendation ${rec.impacto}">
                    <strong>${rec.tipo}:</strong> ${rec.texto}
                </div>
            `).join('')}
        `;
    }

    /**
     * Utilitários
     */
    calcularPercentis(valores) {
        const sorted = [...valores].sort((a, b) => a - b);
        return {
            p10: sorted[Math.floor(sorted.length * 0.1)],
            p50: sorted[Math.floor(sorted.length * 0.5)],
            p90: sorted[Math.floor(sorted.length * 0.9)]
        };
    }

    formatarMoeda(valor) {
        return valor.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    }

    formatarPercentual(valor) {
        return (valor * 100).toFixed(2) + '%';
    }

    gerarRecomendacoes(resultados) {
        // Implementar lógica de recomendações baseada nos resultados
        const recomendacoes = [];
        const { saldoFinal, metricas } = resultados;

        // Análise de rentabilidade
        if (saldoFinal.pgblLiquido > saldoFinal.cdbLiquido) {
            recomendacoes.push({
                tipo: 'Rentabilidade',
                texto: 'PGBL apresenta maior rentabilidade líquida',
                impacto: 'positive'
            });
        } else {
            recomendacoes.push({
                tipo: 'Rentabilidade',
                texto: 'CDB apresenta maior rentabilidade líquida',
                impacto: 'positive'
            });
        }

        // Análise de risco
        if (metricas.risco.pgbl.volatilidade > metricas.risco.cdb.volatilidade) {
            recomendacoes.push({
                tipo: 'Risco',
                texto: 'PGBL apresenta maior volatilidade',
                impacto: 'negative'
            });
        }

        // Outras análises podem ser adicionadas aqui

        return recomendacoes;
    }
}

// Exportar classe
window.ResultVisualizer = ResultVisualizer;