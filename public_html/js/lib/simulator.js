/**
 * Principal classe de simulação PGBL vs CDB
 */
class InvestmentSimulator {
    constructor(calculator) {
        this.calculator = calculator;
    }

    /**
     * Realiza a simulação completa
     */
    simular(params) {
        const {
            rendaTributavel,
            aporteInicial = 0,
            anos,
            taxaCDI,
            inflacaoAnual = 0.045 // 4.5% a.a. padrão
        } = params;

        // Validar parâmetros
        this.validarParametros(params);

        // Constantes
        const aliquotaIR = 0.275; // 27.5%
        const aporteAnual = rendaTributavel * 0.12;
        const meses = anos * 12;
        
        // Inicializar arrays de evolução
        const evolucao = {
            pgblBruto: [aporteInicial],
            pgblLiquido: [aporteInicial],
            cdbBruto: [aporteInicial],
            cdbLiquido: [aporteInicial]
        };

        // Calcular evolução mensal
        let pgblSaldo = aporteInicial;
        let cdbSaldo = aporteInicial;
        let pgblDesembolso = aporteInicial;
        let cdbDesembolso = aporteInicial;
        const aporteMensal = aporteAnual / 12;
        const taxaMensal = taxaCDI / 12;

        // Arrays para fluxo de caixa
        const fluxoCaixaPGBL = [-aporteInicial];
        const fluxoCaixaCDB = [-aporteInicial];

        for (let mes = 1; mes <= meses; mes++) {
            // PGBL
            pgblSaldo = this.calculator.futureValue(pgblSaldo, aporteMensal, taxaMensal, 1);
            const aliquotaPGBL = this.calculator.calcularAliquotaIRPGBL(Math.ceil(mes / 12));
            const pgblLiquido = pgblSaldo * (1 - aliquotaPGBL);
            
            // Considerar benefício fiscal no PGBL
            const beneficioFiscal = mes % 12 === 0 ? this.calculator.calcularBeneficioFiscalPGBL(rendaTributavel, aporteAnual, aliquotaIR) : 0;
            pgblDesembolso += aporteMensal;
            
            // CDB
            cdbSaldo = this.calculator.futureValue(cdbSaldo, aporteMensal, taxaMensal, 1);
            const rendimentoCDB = cdbSaldo - cdbDesembolso;
            const aliquotaCDB = this.calculator.calcularAliquotaIRCDB(mes);
            const cdbLiquido = cdbSaldo - (rendimentoCDB * aliquotaCDB);
            cdbDesembolso += aporteMensal;

            // Registrar evolução
            evolucao.pgblBruto.push(pgblSaldo);
            evolucao.pgblLiquido.push(pgblLiquido);
            evolucao.cdbBruto.push(cdbSaldo);
            evolucao.cdbLiquido.push(cdbLiquido);

            // Registrar fluxo de caixa
            fluxoCaixaPGBL.push(-aporteMensal + (mes % 12 === 0 ? beneficioFiscal : 0));
            fluxoCaixaCDB.push(-aporteMensal);
        }

        // Adicionar valor final ao fluxo de caixa
        fluxoCaixaPGBL[fluxoCaixaPGBL.length - 1] += evolucao.pgblLiquido[evolucao.pgblLiquido.length - 1];
        fluxoCaixaCDB[fluxoCaixaCDB.length - 1] += evolucao.cdbLiquido[evolucao.cdbLiquido.length - 1];

        // Calcular métricas de risco
        const metricasPGBL = this.calculator.calcularMetricasRisco(evolucao.pgblLiquido);
        const metricasCDB = this.calculator.calcularMetricasRisco(evolucao.cdbLiquido);

        // Gerar cenários
        const cenariosPGBL = this.calculator.gerarCenarios(evolucao.pgblLiquido, 1000);
        const cenariosCDB = this.calculator.gerarCenarios(evolucao.cdbLiquido, 1000);

        return {
            evolucao,
            fluxoCaixa: {
                pgbl: fluxoCaixaPGBL,
                cdb: fluxoCaixaCDB
            },
            desembolso: {
                pgbl: pgblDesembolso,
                cdb: cdbDesembolso
            },
            saldoFinal: {
                pgblBruto: pgblSaldo,
                pgblLiquido: evolucao.pgblLiquido[evolucao.pgblLiquido.length - 1],
                cdbBruto: cdbSaldo,
                cdbLiquido: evolucao.cdbLiquido[evolucao.cdbLiquido.length - 1]
            },
            metricas: {
                tir: {
                    pgbl: this.calculator.calcularTIR(fluxoCaixaPGBL),
                    cdb: this.calculator.calcularTIR(fluxoCaixaCDB)
                },
                risco: {
                    pgbl: metricasPGBL,
                    cdb: metricasCDB
                }
            },
            cenarios: {
                pgbl: cenariosPGBL,
                cdb: cenariosCDB
            }
        };
    }

    /**
     * Valida os parâmetros de entrada
     */
    validarParametros(params) {
        const { rendaTributavel, anos, taxaCDI } = params;
        
        if (!rendaTributavel || rendaTributavel <= 0) {
            throw new Error("Renda tributável inválida");
        }
        if (!anos || anos <= 0) {
            throw new Error("Período de investimento inválido");
        }
        if (!taxaCDI || taxaCDI <= 0) {
            throw new Error("Taxa CDI inválida");
        }
    }

    /**
     * Gera recomendações baseadas nos resultados
     */
    gerarRecomendacoes(resultados) {
        const recomendacoes = [];
        const { saldoFinal, metricas } = resultados;
        
        // Análise de rentabilidade
        if (saldoFinal.pgblLiquido > saldoFinal.cdbLiquido) {
            recomendacoes.push({
                tipo: 'rentabilidade',
                texto: `O PGBL apresenta melhor rentabilidade líquida, com diferença de ${(saldoFinal.pgblLiquido - saldoFinal.cdbLiquido).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})}`,
                impacto: 'positivo'
            });
        } else {
            recomendacoes.push({
                tipo: 'rentabilidade',
                texto: `O CDB apresenta melhor rentabilidade líquida, com diferença de ${(saldoFinal.cdbLiquido - saldoFinal.pgblLiquido).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})}`,
                impacto: 'positivo'
            });
        }

        // Análise de risco
        if (metricas.risco.pgbl.volatilidade > metricas.risco.cdb.volatilidade) {
            recomendacoes.push({
                tipo: 'risco',
                texto: 'O PGBL apresenta maior volatilidade. Considere seu perfil de risco.',
                impacto: 'negativo'
            });
        }

        // Análise de eficiência
        const eficienciaPGBL = metricas.risco.pgbl.sharpe;
        const eficienciaCDB = metricas.risco.cdb.sharpe;
        
        if (Math.abs(eficienciaPGBL - eficienciaCDB) > 0.1) {
            const maisEficiente = eficienciaPGBL > eficienciaCDB ? 'PGBL' : 'CDB';
            recomendacoes.push({
                tipo: 'eficiencia',
                texto: `O ${maisEficiente} apresenta melhor relação risco/retorno.`,
                impacto: 'positivo'
            });
        }

        // Análise de prazo
        if (metricas.tir.pgbl > metricas.tir.cdb) {
            recomendacoes.push({
                tipo: 'prazo',
                texto: 'O PGBL tem maior TIR, sendo mais vantajoso no longo prazo.',
                impacto: 'positivo'
            });
        }

        return recomendacoes;
    }
}

// Exportar classe
window.InvestmentSimulator = InvestmentSimulator;