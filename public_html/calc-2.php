/* Continua o conteúdo anterior... */

            /**
             * Calcula alíquota de IR do CDB
             */
            calcularAliquotaIRCDB(meses) {
                if (meses <= 6) return 0.225;
                if (meses <= 12) return 0.20;
                if (meses <= 24) return 0.175;
                return 0.15;
            }

            /**
             * Atualiza gráficos e visualizações
             */
            atualizarVisualizacoes(resultado) {
                this.atualizarGraficoEvolucao(resultado.evolucao);
                this.atualizarDetalhamento(resultado.detalhamento);
                this.atualizarMetricas(resultado.saldos);
                this.atualizarAnaliseComparativa(resultado.saldos);
            }

            /**
             * Atualiza gráfico de evolução patrimonial
             */
            atualizarGraficoEvolucao(evolucao) {
                const ctx = document.getElementById('graficoEvolucao').getContext('2d');
                
                if (this.charts.evolucao) {
                    this.charts.evolucao.destroy();
                }

                this.charts.evolucao = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: evolucao.pgbl.map((_, i) => `Ano ${i}`),
                        datasets: [
                            {
                                label: 'PGBL',
                                data: evolucao.pgbl,
                                borderColor: '#3498db',
                                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                                fill: true
                            },
                            {
                                label: 'CDB',
                                data: evolucao.cdb,
                                borderColor: '#2ecc71',
                                backgroundColor: 'rgba(46, 204, 113, 0.1)',
                                fill: true
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
                                        return context.dataset.label + ": R$ " + 
                                            context.parsed.y.toLocaleString('pt-BR', {
                                                maximumFractionDigits: 2
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
                                        return "R$ " + value.toLocaleString('pt-BR', {
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
             * Atualiza tabela de detalhamento
             */
            atualizarDetalhamento(detalhamento) {
                const tbody = document.querySelector('#tabelaDetalhes tbody');
                tbody.innerHTML = detalhamento.map(d => `
                    <tr>
                        <td>${d.ano}</td>
                        <td>R$ ${d.aportePGBL.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</td>
                        <td>R$ ${d.restituicao.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</td>
                        <td>R$ ${d.saldoPGBL.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</td>
                        <td>R$ ${d.aporteCDB.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</td>
                        <td>R$ ${d.saldoCDB.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</td>
                    </tr>
                `).join('');
            }

            /**
             * Atualiza métricas principais
             */
            atualizarMetricas(saldos) {
                const metricas = document.getElementById('metricas');
                metricas.innerHTML = `
                    <div class="metric-card">
                        <div class="metric-label">PGBL - Valor Final Líquido</div>
                        <div class="metric-value">R$ ${saldos.pgbl.liquido.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-label">CDB - Valor Final Líquido</div>
                        <div class="metric-value">R$ ${saldos.cdb.liquido.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-label">PGBL - IR Total</div>
                        <div class="metric-value">R$ ${saldos.pgbl.ir.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-label">CDB - IR Total</div>
                        <div class="metric-value">R$ ${saldos.cdb.ir.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</div>
                    </div>
                `;
            }

            /**
             * Atualiza análise comparativa
             */
            atualizarAnaliseComparativa(saldos) {
                const diferenca = saldos.pgbl.liquido - saldos.cdb.liquido;
                const melhorOpcao = diferenca > 0 ? 'PGBL' : 'CDB';
                const diferencaAbs = Math.abs(diferenca);
                
                const analise = document.getElementById('analiseComparativa');
                analise.innerHTML = `
                    <div class="scenario-card">
                        <h4>Análise Final</h4>
                        <p>A melhor opção é o <strong>${melhorOpcao}</strong>, com uma diferença de 
                           R$ ${diferencaAbs.toLocaleString('pt-BR', { maximumFractionDigits: 2 })} 
                           no resultado final.</p>
                        <p>PGBL:</p>
                        <ul>
                            <li>Desembolso total: R$ ${saldos.pgbl.desembolso.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</li>
                            <li>Retorno líquido: ${((saldos.pgbl.liquido / saldos.pgbl.desembolso - 1) * 100).toFixed(2)}%</li>
                        </ul>
                        <p>CDB:</p>
                        <ul>
                            <li>Desembolso total: R$ ${saldos.cdb.desembolso.toLocaleString('pt-BR', { maximumFractionDigits: 2 })}</li>
                            <li>Retorno líquido: ${((saldos.cdb.liquido / saldos.cdb.desembolso - 1) * 100).toFixed(2)}%</li>
                        </ul>
                    </div>
                `;
            }
        }

        // Instancia o simulador
        const simulador = new Simulador();

        /**
         * Função principal de cálculo
         */
        function calcular() {
            try {
                // Mostrar loading
                document.getElementById('loading').classList.add('active');

                // Obter valores
                const rendaTributavel = parseFloat(document.getElementById('rendaTributavel').value);
                const aporteInicial = parseFloat(document.getElementById('aporteInicial').value) || 0;
                const anos = parseInt(document.getElementById('anos').value);
                const taxaCDI = parseFloat(document.getElementById('cdi').value) / 100;

                // Validar entradas
                if (!validarEntradas(rendaTributavel, anos, taxaCDI)) {
                    return;
                }

                // Calcular resultados
                const resultado = simulador.calcular(rendaTributavel, aporteInicial, anos, taxaCDI);

                // Atualizar visualizações
                simulador.atualizarVisualizacoes(resultado);

                // Mostrar resultados
                document.getElementById('resultados').style.display = 'block';
            } catch (error) {
                alert('Erro ao calcular: ' + error.message);
            } finally {
                // Esconder loading
                document.getElementById('loading').classList.remove('active');
            }
        }

        /**
         * Validação de entradas
         */
        function validarEntradas(rendaTributavel, anos, taxaCDI) {
            if (isNaN(rendaTributavel) || rendaTributavel <= 0) {
                alert('Por favor, informe uma renda tributável válida.');
                return false;
            }
            if (isNaN(anos) || anos <= 0) {
                alert('Por favor, informe um período válido.');
                return false;
            }
            if (isNaN(taxaCDI) || taxaCDI <= 0) {
                alert('Por favor, informe uma taxa CDI válida.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>