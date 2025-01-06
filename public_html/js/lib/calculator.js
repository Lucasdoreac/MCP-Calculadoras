/**
 * Biblioteca de cálculos financeiros
 */
class FinancialCalculator {
    /**
     * Calcula o valor futuro de um investimento
     */
    static futureValue(principal, monthlyContribution, rate, months) {
        let balance = principal;
        for (let i = 0; i < months; i++) {
            balance = balance * (1 + rate) + monthlyContribution;
        }
        return balance;
    }

    /**
     * Calcula a alíquota de IR do PGBL
     */
    static calcularAliquotaIRPGBL(anos) {
        if (anos <= 2) return 0.35;
        if (anos <= 4) return 0.30;
        if (anos <= 6) return 0.20;
        if (anos <= 8) return 0.15;
        return 0.10;
    }

    /**
     * Calcula a alíquota de IR do CDB
     */
    static calcularAliquotaIRCDB(meses) {
        if (meses <= 6) return 0.225;
        if (meses <= 12) return 0.20;
        if (meses <= 24) return 0.175;
        return 0.15;
    }

    /**
     * Calcula o benefício fiscal do PGBL
     */
    static calcularBeneficioFiscalPGBL(rendaAnual, aporte, aliquotaIR) {
        const limiteAporte = rendaAnual * 0.12;
        const aporteEfetivo = Math.min(aporte, limiteAporte);
        return aporteEfetivo * aliquotaIR;
    }

    /**
     * Calcula a TIR (Taxa Interna de Retorno)
     */
    static calcularTIR(fluxoCaixa, tentativas = 1000) {
        let taxaMin = -0.99;
        let taxaMax = 10;
        let taxa = 0;
        
        for (let i = 0; i < tentativas; i++) {
            taxa = (taxaMin + taxaMax) / 2;
            let vpla = this.calcularVPL(fluxoCaixa, taxa);
            
            if (Math.abs(vpla) < 0.000001) break;
            
            if (vpla > 0) {
                taxaMin = taxa;
            } else {
                taxaMax = taxa;
            }
        }
        
        return taxa;
    }

    /**
     * Calcula o VPL (Valor Presente Líquido)
     */
    static calcularVPL(fluxoCaixa, taxa) {
        return fluxoCaixa.reduce((sum, valor, i) => {
            return sum + valor / Math.pow(1 + taxa, i);
        }, 0);
    }

    /**
     * Calcula métricas de risco
     */
    static calcularMetricasRisco(fluxoCaixa) {
        const n = fluxoCaixa.length;
        if (n < 2) return { volatilidade: 0, sharpe: 0 };

        // Calcular retornos
        const retornos = [];
        for (let i = 1; i < n; i++) {
            retornos.push((fluxoCaixa[i] - fluxoCaixa[i-1]) / fluxoCaixa[i-1]);
        }

        // Média dos retornos
        const mediaRetornos = retornos.reduce((a, b) => a + b) / retornos.length;

        // Volatilidade (desvio padrão)
        const variancia = retornos.reduce((sum, ret) => {
            return sum + Math.pow(ret - mediaRetornos, 2);
        }, 0) / (retornos.length - 1);
        const volatilidade = Math.sqrt(variancia);

        // Índice Sharpe (considerando taxa livre de risco de 5% a.a.)
        const taxaLivreRisco = 0.05 / 12; // Mensal
        const sharpe = (mediaRetornos - taxaLivreRisco) / volatilidade;

        return {
            volatilidade,
            sharpe,
            mediaRetornos
        };
    }
    
    /**
     * Gera cenários de investimento usando simulação de Monte Carlo
     */
    static gerarCenarios(valoresBase, numCenarios = 1000) {
        const cenarios = [];
        const volatilidade = this.calcularMetricasRisco(valoresBase).volatilidade;
        
        for (let i = 0; i < numCenarios; i++) {
            const cenario = [valoresBase[0]];
            for (let j = 1; j < valoresBase.length; j++) {
                const retornoEsperado = (valoresBase[j] / valoresBase[j-1]) - 1;
                const aleatorio = this.gerarNormal(0, 1);
                const retornoSimulado = retornoEsperado + volatilidade * aleatorio;
                cenario.push(cenario[j-1] * (1 + retornoSimulado));
            }
            cenarios.push(cenario);
        }

        return cenarios;
    }

    /**
     * Gera número aleatório com distribuição normal
     */
    static gerarNormal(media = 0, desvio = 1) {
        let u = 0, v = 0;
        while (u === 0) u = Math.random();
        while (v === 0) v = Math.random();
        return Math.sqrt(-2.0 * Math.log(u)) * Math.cos(2.0 * Math.PI * v) * desvio + media;
    }
}