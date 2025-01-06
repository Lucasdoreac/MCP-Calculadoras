class InvestmentAnalyzer {
    constructor() {
        this.riskLevels = {
            VERY_LOW: { min: 0, max: 2, description: "Muito Baixo" },
            LOW: { min: 2, max: 4, description: "Baixo" },
            MEDIUM: { min: 4, max: 6, description: "Médio" },
            HIGH: { min: 6, max: 8, description: "Alto" },
            VERY_HIGH: { min: 8, max: 10, description: "Muito Alto" }
        };
    }

    calculateInvestmentResults(params) {
        const {
            valorInicial,
            aporteMensal,
            prazo,
            taxaMensal,
            inflacao,
            perfilRisco
        } = params;

        // Cálculos base
        let valorFinal = valorInicial;
        let investimentoTotal = valorInicial;
        let valoresMensais = [valorInicial];
        
        for (let i = 0; i < prazo; i++) {
            valorFinal = valorFinal * (1 + taxaMensal) + aporteMensal;
            investimentoTotal += aporteMensal;
            valoresMensais.push(valorFinal);
        }

        // Cálculos adicionais
        const ganhoTotal = valorFinal - investimentoTotal;
        const inflacaoAcumulada = Math.pow(1 + inflacao, prazo / 12) - 1;
        const valorFinalAjustado = valorFinal / (1 + inflacaoAcumulada);
        const rentabilidadeReal = (valorFinalAjustado / investimentoTotal - 1) * 100;
        
        // Análise de risco
        const volatilidade = this.calculateVolatility(valoresMensais);
        const sharpeRatio = this.calculateSharpeRatio(rentabilidadeReal, volatilidade, inflacao);
        
        return {
            valorFinal,
            ganhoTotal,
            rentabilidadeReal,
            inflacaoAcumulada,
            valorFinalAjustado,
            investimentoTotal,
            volatilidade,
            sharpeRatio,
            valoresMensais,
            analiseRisco: this.analyzeRisk(volatilidade, perfilRisco)
        };
    }

    calculateVolatility(values) {
        const returns = [];
        for (let i = 1; i < values.length; i++) {
            returns.push((values[i] - values[i-1]) / values[i-1]);
        }
        
        const mean = returns.reduce((a, b) => a + b, 0) / returns.length;
        const squaredDiffs = returns.map(r => Math.pow(r - mean, 2));
        const variance = squaredDiffs.reduce((a, b) => a + b, 0) / returns.length;
        
        return Math.sqrt(variance) * Math.sqrt(12); // Anualizado
    }

    calculateSharpeRatio(return_, volatility, riskFreeRate) {
        return (return_ - riskFreeRate) / volatility;
    }

    analyzeRisk(volatility, perfilRisco) {
        const riskScore = volatility * 10;
        let riskLevel = '';
        let recommendation = '';
        
        if (riskScore < this.riskLevels.VERY_LOW.max) {
            riskLevel = this.riskLevels.VERY_LOW.description;
        } else if (riskScore < this.riskLevels.LOW.max) {
            riskLevel = this.riskLevels.LOW.description;
        } else if (riskScore < this.riskLevels.MEDIUM.max) {
            riskLevel = this.riskLevels.MEDIUM.description;
        } else if (riskScore < this.riskLevels.HIGH.max) {
            riskLevel = this.riskLevels.HIGH.description;
        } else {
            riskLevel = this.riskLevels.VERY_HIGH.description;
        }

        if (riskScore > perfilRisco + 2) {
            recommendation = "O investimento possui risco acima do seu perfil. Considere opções mais conservadoras.";
        } else if (riskScore < perfilRisco - 2) {
            recommendation = "O investimento possui risco abaixo do seu perfil. Você poderia considerar opções com maior potencial de retorno.";
        } else {
            recommendation = "O nível de risco está adequado ao seu perfil de investidor.";
        }

        return {
            score: riskScore,
            level: riskLevel,
            recommendation
        };
    }

    generateReport(results) {
        const formatCurrency = (value) => {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(value);
        };

        const formatPercent = (value) => {
            return `${value.toFixed(2)}%`;
        };

        return {
            resumo: {
                title: "Resumo do Investimento",
                content: `
                    Valor Final: ${formatCurrency(results.valorFinal)}
                    Ganho Total: ${formatCurrency(results.ganhoTotal)}
                    Rentabilidade Real: ${formatPercent(results.rentabilidadeReal)}
                    Valor Final Ajustado pela Inflação: ${formatCurrency(results.valorFinalAjustado)}
                `
            },
            analiseRisco: {
                title: "Análise de Risco",
                content: `
                    Nível de Risco: ${results.analiseRisco.level}
                    Volatilidade Anual: ${formatPercent(results.volatilidade * 100)}
                    Índice Sharpe: ${results.sharpeRatio.toFixed(2)}
                    ${results.analiseRisco.recommendation}
                `
            },
            recomendacoes: {
                title: "Recomendações",
                content: this.generateRecommendations(results)
            }
        };
    }

    generateRecommendations(results) {
        const recommendations = [];

        if (results.valorFinal > 100000) {
            recommendations.push("Considere diversificar seus investimentos em diferentes classes de ativos para reduzir o risco.");
        }

        if (results.rentabilidadeReal < results.inflacaoAcumulada) {
            recommendations.push("O retorno real está abaixo da inflação. Considere investimentos com maior potencial de rentabilidade.");
        }

        if (results.sharpeRatio < 0.5) {
            recommendations.push("A relação risco/retorno está baixa. Avalie alternativas de investimento com melhor eficiência.");
        }

        if (results.valoresMensais.length < 60) {
            recommendations.push("Para investimentos de longo prazo, considere aumentar o período de investimento para aproveitar melhor o efeito dos juros compostos.");
        }

        return recommendations.join('\n');
    }

    generateSensitivityAnalysis(baseParams) {
        const variations = [-0.2, -0.1, 0, 0.1, 0.2];
        const results = {};

        results.taxaJuros = variations.map(variation => {
            const newTaxa = baseParams.taxaMensal * (1 + variation);
            const result = this.calculateInvestmentResults({
                ...baseParams,
                taxaMensal: newTaxa
            });
            return {
                variacao: variation * 100,
                valorFinal: result.valorFinal,
                rentabilidadeReal: result.rentabilidadeReal
            };
        });

        results.aporteMensal = variations.map(variation => {
            const newAporte = baseParams.aporteMensal * (1 + variation);
            const result = this.calculateInvestmentResults({
                ...baseParams,
                aporteMensal: newAporte
            });
            return {
                variacao: variation * 100,
                valorFinal: result.valorFinal,
                rentabilidadeReal: result.rentabilidadeReal
            };
        });

        return results;
    }
}

// Exportar a classe para uso global
window.InvestmentAnalyzer = InvestmentAnalyzer;