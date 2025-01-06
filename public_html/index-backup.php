<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador Educacional de Investimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
/* Estilos gerais */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1e1e1e; /* Fundo preto */
            color: #fff; /* Texto branco */
            line-height: 1.6;
        }
         /* Estilos para a navbar  (altura) */
       .navbar-custom {
         height: 70px;
       }
        .navbar .container {
         width: 100%;
         max-width: 100%;
          display: flex;
         align-items: center;
         justify-content: space-between;
        }
    .container {
         margin: 40px auto;
           padding: 20px;
         padding-left: 5px;
            padding-right: 5px;
          background: #2c2c2c;
           border-radius: 10px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
       }
        @media (min-width: 1200px) {
           .container {
                 max-width: 1000px;
            }
       }
        h1, h2, h3, h4 {
            color: #fff; /* Títulos brancos */
            margin-bottom: 15px;
        }
        h1 {
           text-align: center;
           font-size: 2em;
            margin-bottom: 30px;
        }
         .form-group {
            margin-bottom: 20px;
             width: 100%;
        }
         label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #bbb; /* Labels mais claras */
       }
         input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
           border-radius: 5px;
           font-size: 16px;
            margin-top: 5px;
            background-color: #333;
            color: #fff;
            box-sizing: border-box;
        }
        button {
           width: 100%;
           padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
           font-size: 16px;
            transition: background-color 0.3s;
            box-sizing: border-box;
        }
        button:hover {
            background-color: #2980b9;
        }
         .educational-tips {
            background: #333; /* Fundo da dica */
            padding: 20px;
           border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
       }
        .concept-explanation {
            display: none;
            background: #333; /* Fundo da explicação */
           padding: 15px;
            border: 1px solid #555;
           border-radius: 5px;
            margin-top: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .help-icon {
            display: inline-block;
           width: 20px;
           height: 20px;
            line-height: 20px;
           text-align: center;
            background: #555; /* Ícone de ajuda */
            color: #fff;
            border-radius: 50%;
           cursor: pointer;
            margin-left: 5px;
            font-size: 14px;
            transition: background-color 0.3s;
        }
         .help-icon:hover {
           background: #444;
        }
        .goals-section {
            background: #333; /* Seção de metas */
           padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #555; /* Borda mais escura */
        }
       .tab-container {
            margin: 20px 0;
        }
        .tab-buttons {
           display: flex;
            gap: 10px;
           margin-bottom: 15px;
            border-bottom: 2px solid #555;
           padding-bottom: 10px;
        }
        .container-botoes {
            display: flex;
           flex-wrap: wrap;
           justify-content: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }
       .container-botoes button {
            flex: 0 1 auto;
           width: auto; /* Faz com que o botão ocupe o seu espaço */
           padding: 0.6rem 0.8rem;
        }
        .tab-button {
            padding: 10px 20px;
            border: none;
           background: #444; /* Botões da aba */
            cursor: pointer;
           border-radius: 5px 5px 0 0;
           font-weight: bold;
            transition: all 0.3s;
            color: #fff; /* Texto dos botões da aba */
           box-sizing: border-box;
       }
         .tab-button.active {
            background: #3498db;
            color: white;
        }
       .tab-content {
           display: none;
           padding: 20px;
            background: #333; /* Conteúdo da aba */
           border-radius: 5px;
           box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
       .tab-content.active {
           display: block;
       }
        .comparison-table {
           width: 100%;
           border-collapse: collapse;
            margin: 20px 0;
           background: #444;
           overflow-x: auto;
       }
        .comparison-table th, .comparison-table td {
           padding: 12px;
           border: 1px solid #555;
            text-align: left;
            color: #fff; /* Texto da tabela */
        }
        .comparison-table th {
           background: #555;
            font-weight: bold;
           color: #fff; /* Texto do cabeçalho da tabela */
        }
        .comparison-table tr:nth-child(even) {
            background: #555; /* Linhas pares da tabela */
       }
        .milestone-alert {
           background: #444;
           color: #2ecc71; /* Cor do texto de alerta */
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
           display: none;
            border: 1px solid #555;
        }
         .results {
            background: #333;
            padding: 20px;
           border-radius: 5px;
           margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
           color: #fff; /* Texto dos resultados */
        }
        .results p {
           margin: 10px 0;
            padding: 8px;
            border-bottom: 1px solid #555; /* Borda dos resultados */
        }
       .results strong {
           color: #3498db;
        }
        .chart-container {
            margin-top: 20px;
           padding: 20px;
            background: #333;
           border-radius: 5px;
           box-shadow: 0 2px 4px rgba(0,0,0,0.3);
            overflow-x: auto;
       }
       .educational-content {
            padding: 20px;
            background: #333; /* Fundo do conteúdo educacional */
           border-radius: 5px;
        }
        .educational-content h4 {
            color: #fff; /* Texto do título do conteúdo educacional */
           margin-top: 20px;
       }
       .educational-content ul {
            padding-left: 20px;
       }
       .educational-content li {
           margin-bottom: 10px;
        }
        .risk-meter {
           width: 100%;
           height: 20px;
           background: linear-gradient(to right, #2ecc71, #f1c40f, #e74c3c);
            border-radius: 10px;
            margin: 10px 0;
           position: relative;
        }
        .risk-indicator {
            width: 10px;
           height: 30px;
           background: #2c3e50;
            position: absolute;
            top: -5px;
           transform: translateX(-50%);
           transition: left 0.3s;
        }
        .highlight {
            background-color: #555; /* Fundo do destaque */
       }
        .instruction {
            color: #e74c3c;
           font-size: 0.9em;
            margin-top: 5px;
        }
         /* General Navbar Styles */
        .navbar {
            max-width: 100%;
           padding-top: 0.3rem;
            padding-bottom: 0.5rem;
            padding-left: 10px;
            padding-right: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            background-color: #2c2c2c; /* Background color */
            transition: all 0.3s ease; /* Smooth transitions */
       }
         .navbar-brand {
            font-weight: 700;
           font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.9) !important; /* Brand text color */
            transition: color 0.3s ease; /* Smooth hover transition */
        }
         .navbar-brand:hover {
            color: #fff !important; /* Hover color for brand */
        }
        .navbar-nav .nav-link {
           padding: 0.5rem 1rem !important;
            color: rgba(255, 255, 255, 0.9) !important; /* Link text color */
           transition: color 0.3s ease, background-color 0.3s ease; /* Smooth transitions */
           position: relative;
        }
        .navbar-nav .nav-link:hover {
           color: #fff !important; /* Hover effect for links */
           background-color: rgba(255, 255, 255, 0.1); /* Subtle background hover */
            border-radius: 5px; /* Rounded corners for hover */
        }
        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            border-radius: 0.5rem;
            background-color: #444; /* Dropdown background color */
       }
        .dropdown-item {
            padding: 0.7rem 1.5rem;
           color: #fff; /* Dropdown text color */
            transition: all 0.3s ease; /* Smooth hover transition */
       }
        .dropdown-item:hover {
            background-color: #555; /* Hover background color */
            color: #007bff; /* Hover text color */
       }
        /* Mobile Optimizations */
       @media (max-width: 991.98px) {
           .navbar {
                padding: 0.2rem 1rem;
                padding-left: 5px;
                padding-right: 5px;
           }
            .navbar-nav {
               padding: 0.2rem 0;
           }
            .navbar-nav .nav-link {
                padding: 0.8rem 1rem !important;
               color: rgba(255, 255, 255, 0.9) !important; /* Mobile link color */
            }
           .navbar-nav .nav-link:hover {
                color: #fff !important; /* Mobile link hover color */
               background-color: rgba(255, 255, 255, 0.1); /* Mobile hover effect */
            }
            .dropdown-menu {
               background-color: #2c2c2c; /* Transparent dropdown background */
               border: none;
                box-shadow: none;
            }
            .dropdown-item {
               color: rgba(255, 255, 255, 0.9) !important;
            }
            .dropdown-item:hover {
                background-color: rgba(255, 255, 255, 0.1); /* Transparent hover effect */
               color: #fff !important;
            }
        }
         /* Estilos do Footer */
        footer {
            background-color: #2c2c2c;
            color: white;
            padding: 40px 0;
            display: flex;
           justify-content: center;
       }
        footer .container {
           max-width: 1000px;
            padding: 0;
        }
        footer .row {
           width: 100%;
       }
        footer a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
           transition: all 0.3s ease;
        }
        footer a:hover {
           color: #fff;
            text-decoration: none;
        }
        footer h5 {
           font-weight: 700;
            margin-bottom: 1.5rem;
        }
        footer .list-unstyled li {
           margin-bottom: 0.5rem;
        }
        footer hr {
            border-color: rgba(255,255,255,0.1);
            margin: 2rem 0;
        }
        footer .social-links {
           font-size: 1.5rem;
       }
       footer .social-links a {
            margin-right: 1rem;
        }
        footer .social-links a:hover {
            transform: translateY(-3px);
            display: inline-block;
       }
       @media (max-width: 768px) {
           footer [class^="col-"] {
            padding-left: 5px;
            padding-right: 5px;
          }
        }
        @media (max-width: 576px) { /* Ajuste para telas menores que 576px */
          .navbar {
             padding-left: 2px;
            padding-right: 2px;
            }
       }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="index.php">Luciana Araujo</a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
           <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Calculadoras
                        </a>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="index.php">Calculadora Principal</a></li>
                           <li><a class="dropdown-item" href="calc-2.php">Simulador PGBL vs CDB</a></li>
                            <li><a class="dropdown-item" href="calc-3.php">Simulador de Investimentos</a></li>
                       </ul>
                   </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.linkedin.com/in/luciana-g-araujo-cea-cnpi-p-pqo-06a858b8/" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </li>
                   <li class="nav-item">
                       <a class="nav-link" href="mailto:contato@luaraujo.com">
                            <i class="fas fa-envelope"></i>
                       </a>
                    </li>
               </ul>
           </div>
       </div>
    </nav>
     <div class="container">
        <h1>Simulador Educacional de Investimentos</h1>
        <div class="educational-tips">
            <h3>Conceitos Básicos de Investimentos <span class="help-icon" onclick="toggleTips()">?</span></h3>
             <div id="tipsContent" class="concept-explanation">
                <h4>Conceitos Importantes:</h4>
                <ul>
                    <li><strong>Juros Compostos:</strong> São os juros que incidem não apenas sobre o capital inicial, mas também sobre os juros acumulados em períodos anteriores. É o chamado "juros sobre juros".</li>
                   <li><strong>CDI (Certificado de Depósito Interbancário):</strong> É uma taxa de referência no mercado financeiro brasileiro, muito utilizada para remunerar investimentos de renda fixa.</li>
                    <li><strong>Renda Fixa vs Renda Variável:</strong> Renda fixa tem retornos mais previsíveis e menor risco, enquanto renda variável pode ter maiores retornos mas com maior risco.</li>
                    <li><strong>Inflação:</strong> Aumento generalizado dos preços que reduz o poder de compra do dinheiro ao longo do tempo.</li>
                     <li><strong>Diversificação:</strong> Estratégia de distribuir investimentos em diferentes tipos de ativos para reduzir riscos.</li>
                </ul>
            </div>
        </div>
        <div class="goals-section">
            <h3>Planejamento Financeiro</h3>
            <div class="form-group">
               <label for="goalAmount">Meta Financeira (R$):</label>
               <input type="number" id="goalAmount">
                <span class="help-icon" onclick="showConcept('goal')">?</span>
               <div id="goalConcept" class="concept-explanation">
                    <p>Defina o valor que deseja acumular. Exemplos: reserva de emergência, entrada para um imóvel, aposentadoria, etc.</p>
                </div>
            </div>
             <div class="form-group">
                <label for="goalYears">Prazo para atingir a meta (anos):</label>
                <input type="number" id="goalYears">
           </div>
        </div>
        <form id="simulador-form">
            <div class="form-group">
                <label for="valorInicial">Valor Inicial (R$):</label>
               <input type="number" id="valorInicial" required>
               <span class="help-icon" onclick="showConcept('valorInicial')">?</span>
                <div id="valorInicialConcept" class="concept-explanation">
                    <p>Informe o valor inicial que você tem para investir.</p>
                </div>
           </div>
            <div class="form-group">
                <label for="aporteMensal">Aporte Mensal (R$):</label>
               <input type="number" id="aporteMensal" required>
                <span class="help-icon" onclick="showConcept('aporteMensal')">?</span>
                <div id="aporteMensalConcept" class="concept-explanation">
                   <p>Informe o valor que você pode investir mensalmente.</p>
                </div>
           </div>
            <div class="form-group">
                <label for="tipoRendimento">Tipo de Rendimento:</label>
               <select id="tipoRendimento" required>
                    <option value="fixa">Taxa Fixa</option>
                   <option value="cdi">Taxa do CDI</option>
                </select>
                <span class="help-icon" onclick="showConcept('tipoRendimento')">?</span>
               <div id="tipoRendimentoConcept" class="concept-explanation">
                   <p>Escolha entre uma taxa fixa ou uma taxa atrelada ao CDI.</p>
                </div>
           </div>
             <div id="taxaFixaGroup" class="form-group">
                <label for="taxaFixa">Taxa Fixa Mensal (%):</label>
                <input type="number" id="taxaFixa" step="0.01">
               <div class="instruction">Informe a taxa de rendimento mensal (em %).</div>
            </div>
             <div id="cdiGroup" style="display: none;">
                 <div class="form-group">
                   <label for="taxaCDI">Taxa CDI Anual (%):</label>
                   <input type="number" id="taxaCDI" step="0.01">
                    <div class="instruction">Informe a taxa do CDI anual (em %).</div>
                </div>
                <div class="form-group">
                    <label for="percentualCDIComImposto">Percentual do CDI - Com IR (%):</label>
                    <input type="number" id="percentualCDIComImposto" step="0.1">
               </div>
                <div class="form-group">
                    <label for="percentualCDISemImposto">Percentual do CDI - Sem IR (%):</label>
                   <input type="number" id="percentualCDISemImposto" step="0.1">
               </div>
           </div>
            <div class="form-group">
                <label for="prazo">Prazo (meses):</label>
               <input type="number" id="prazo" required>
                <span class="help-icon" onclick="showConcept('prazo')">?</span>
                 <div id="prazoConcept" class="concept-explanation">
                    <p>Informe o prazo do investimento em meses.</p>
                </div>
            </div>
            <div class="form-group">
                <label for="inflacao">Inflação Anual Estimada (%):</label>
                <input type="number" id="inflacao" step="0.1">
                <span class="help-icon" onclick="showConcept('inflacao')">?</span>
               <div id="inflacaoConcept" class="concept-explanation">
                    <p>Informe a taxa de inflação anual estimada.</p>
               </div>
            </div>
            <button type="button" onclick="calcularRentabilidade()">Calcular Simulação</button>
        </form>
        <div class="tab-container">
             <div class="container-botoes">
                 <button class="tab-button active" onclick="showTab('resultados')">Resultados</button>
                 <button class="tab-button" onclick="showTab('comparacoes')">Comparações</button>
                 <button class="tab-button" onclick="showTab('educacional')">Material Educativo</button>
                 <button class="tab-button" onclick="showTab('pgblCdb')">PGBL vs CDB</button>
             </div>
            <div id="resultadosTab" class="tab-content active">
                <div id="results" class="results" style="display: none;">
                   <h3>Resultados da Simulação</h3>
                    <p><strong>Valor Inicial:</strong> R$ <span id="resultValorInicial"></span></p>
                    <p><strong>Aporte Mensal:</strong> R$ <span id="resultAporteMensal"></span></p>
                   <p><strong>Prazo:</strong> <span id="resultPrazo"></span> meses</p>
                     <p><strong>Taxa de Rendimento:</strong> <span id="resultTaxaRendimento"></span>% ao mês</p>
                    <p><strong>Valor Final:</strong> R$ <span id="resultValorFinal"></span></p>
                    <p><strong>Ganho Total:</strong> R$ <span id="resultGanhoTotal"></span></p>
                   <p><strong>Inflação Acumulada:</strong> <span id="resultInflacaoAcumulada"></span>%</p>
                   <p><strong>Valor Final Ajustado pela Inflação:</strong> R$ <span id="resultValorFinalAjustado"></span></p>
                    <div class="chart-container">
                        <canvas id="chartSimulacao"></canvas>
                    </div>
                </div>
            </div>
           <div id="comparacoesTab" class="tab-content">
                 <h3>Comparações</h3>
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Investimento</th>
                            <th>Valor Final</th>
                            <th>Ganho Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Poupança</td>
                           <td id="comparacaoPoupancaValorFinal">-</td>
                            <td id="comparacaoPoupancaGanhoTotal">-</td>
                        </tr>
                        <tr>
                           <td>CDB</td>
                            <td id="comparacaoCDBValorFinal">-</td>
                           <td id="comparacaoCDBGanhoTotal">-</td>
                        </tr>
                        <tr>
                            <td>LCI/LCA</td>
                           <td id="comparacaoLCILCAValorFinal">-</td>
                           <td id="comparacaoLCILCAGanhoTotal">-</td>
                       </tr>
                    </tbody>
                </table>
                <div class="chart-container">
                    <canvas id="chartComparacoes"></canvas>
                </div>
                 <div class="educational-content">
                   <h4>Laudo Comparativo</h4>
                    <p id="laudoComparativo"></p>
                    <p id="laudoMeta"></p>
                   <p id="laudoPercentualCDB"></p>
                </div>
           </div>
            <div id="educacionalTab" class="tab-content">
                <h3>Material Educativo</h3>
                <div class="educational-content">
                    <h4>Como Funcionam os Investimentos?</h4>
                    <p>Investir é uma forma de fazer o dinheiro trabalhar para você. Existem diferentes tipos de investimentos, cada um com suas características, riscos e retornos. Aqui estão alguns conceitos básicos:</p>
                    <ul>
                        <li><strong>Renda Fixa:</strong> Investimentos com retornos previsíveis, como títulos públicos e CDBs.</li>
                        <li><strong>Renda Variável:</strong> Investimentos com retornos variáveis, como ações e fundos imobiliários.</li>
                        <li><strong>Diversificação:</strong> Estratégia de distribuir investimentos em diferentes tipos de ativos para reduzir riscos.</li>
                         <li><strong>Juros Compostos:</strong> Juros que incidem sobre o capital inicial e sobre os juros acumulados, gerando crescimento exponencial.</li>
                    </ul>
                </div>
            </div>
           <div id="pgblCdbTab" class="tab-content">
                 <h3>Simulador PGBL vs CDB</h3>
                <form id="simulador-pgbl-cdb">
                    <label for="rendaTributavel">Renda Anual Tributável (R$):</label>
                    <input type="number" id="rendaTributavel" step="0.01" required>
                    <label for="aporteInicial">Aporte Inicial (opcional) - R$:</label>
                    <input type="number" id="aporteInicial" step="0.01" value="0">
                   <label for="anos">Período de Investimento (em anos):</label>
                   <input type="number" id="anos" required min="1">
                   <label for="cdi">Taxa do CDI Anual (%):</label>
                    <input type="number" id="cdi" step="0.01" value="10" required min="0">
                   <button type="button" onclick="calcularPGBLCDB()">Simular</button>
                </form>
                <div class="results" id="resultados-pgbl-cdb" style="display: none;">
                    <h2>Resultados</h2>
                    <p><strong>PGBL:</strong></p>
                    <p>Valor Total Acumulado: R$ <span id="pgblAcumulado"></span></p>
                    <p>Desembolso Efetivo: R$ <span id="pgblDesembolso"></span></p>
                   <p>IR no Resgate: R$ <span id="pgblIR"></span></p>
                    <p>Valor Líquido: R$ <span id="pgblLiquido"></span></p>
                    <p><strong>CDB:</strong></p>
                    <p>Valor Total Acumulado: R$ <span id="cdbAcumulado"></span></p>
                    <p>Desembolso Efetivo: R$ <span id="cdbDesembolso"></span></p>
                   <p>IR no Resgate: R$ <span id="cdbIR"></span></p>
                    <p>Valor Líquido: R$ <span id="cdbLiquido"></span></p>
                     <h3>Detalhamento Anual</h3>
                    <table id="tabelaDetalhes">
                        <thead>
                            <tr>
                               <th>Ano</th>
                                <th>Aporte PGBL (R$)</th>
                                <th>Restituição PGBL (R$)</th>
                                <th>Saldo PGBL (R$)</th>
                                <th>Aporte CDB (R$)</th>
                                <th>Saldo CDB (R$)</th>
                            </tr>
                       </thead>
                        <tbody>
                            <!-- As linhas serão preenchidas pelo JavaScript -->
                        </tbody>
                    </table>
                     <div class="analise">
                       <h3>Análise Comparativa</h3>
                        <p><strong>Diferença Líquida (PGBL - CDB):</strong> R$ <span id="diferencaLiquida"></span></p>
                        <p><strong>Valor Total Restituído (PGBL):</strong> R$ <span id="totalRestituido"></span></p>
                         <p><strong>Resultado Final Ajustado:</strong> R$ <span id="resultadoFinalAjustado"></span></p>
                          <p><strong>Rentabilidade Líquida PGBL:</strong> <span id="rentabilidadePGBL"></span></p>
                        <p><strong>Rentabilidade Líquida CDB:</strong> <span id="rentabilidadeCDB"></span></p>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
               <div class="col-md-4">
                    <h5>Luciana Araujo</h5>
                    <p><i class="fas fa-phone"></i> (61) 98342-6774</p>
                   <p><i class="fas fa-envelope"></i> <a href="mailto:contato@luaraujo.com">contato@luaraujo.com</a></p>
                </div>
                 <div class="col-md-4">
                   <h5>Links Rápidos</h5>
                    <ul class="list-unstyled">
                         <li><a href="index.php">Calculadora Principal</a></li>
                         <li><a href="calc-2.php">Simulador PGBL vs CDB</a></li>
                        <li><a href="calc-3.php">Simulador de Investimentos</a></li>
                   </ul>
                </div>
                <div class="col-md-4">
                    <h5>Redes Sociais</h5>
                   <div class="social-links">
                        <a href="https://www.linkedin.com/in/luciana-g-araujo-cea-cnpi-p-pqo-06a858b8/" class="text-white" target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
           <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                   <p class="mb-0">© <?php echo date('Y'); ?> <a href="https://gravatar.com/lucasdorea" target="_blank">@HAKO</a>. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
        <script>
            // Smooth scroll para links do footer
            document.querySelectorAll('footer a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleTips() {
            const tipsContent = document.getElementById('tipsContent');
            tipsContent.style.display = tipsContent.style.display === 'block' ? 'none' : 'block';
        }
        function showConcept(concept) {
            const conceptElement = document.getElementById(concept + 'Concept');
            conceptElement.style.display = conceptElement.style.display === 'block' ? 'none' : 'block';
        }
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.style.display = 'none');
            document.getElementById(tabId + 'Tab').style.display = 'block';
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(button => button.classList.remove('active'));
            document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
        }
        function calcularRentabilidade() {
            const valorInicial = parseFloat(document.getElementById('valorInicial').value);
            const aporteMensal = parseFloat(document.getElementById('aporteMensal').value);
            const prazo = parseInt(document.getElementById('prazo').value);
            const tipoRendimento = document.getElementById('tipoRendimento').value;
            const taxaFixa = parseFloat(document.getElementById('taxaFixa').value) / 100;
            const taxaCDI = parseFloat(document.getElementById('taxaCDI').value) / 100;
            const percentualCDIComImposto = parseFloat(document.getElementById('percentualCDIComImposto').value) / 100;
            const percentualCDISemImposto = parseFloat(document.getElementById('percentualCDISemImposto').value) / 100;
            const inflacao = parseFloat(document.getElementById('inflacao').value) / 100;
            if (isNaN(valorInicial) || isNaN(aporteMensal) || isNaN(prazo) || isNaN(inflacao)) {
                alert("Preencha todos os campos obrigatórios para calcular a simulação.");
                return;
            }
            // Cálculo do percentual do CDI do CDB necessário para bater o LCI/LCA
            const ir = 0.225; // Imposto de Renda de 22.5% (exemplo)
            const percentualCDIComIRNecessario = percentualCDISemImposto / (1 - ir);
            let taxaMensal;
            if (tipoRendimento === 'fixa') {
                if (isNaN(taxaFixa)) {
                    alert("Preencha a taxa fixa mensal.");
                    return;
                }
                taxaMensal = taxaFixa;
            } else {
                if (isNaN(taxaCDI) || isNaN(percentualCDIComImposto) || isNaN(percentualCDISemImposto)) {
                    alert("Preencha todos os campos relacionados ao CDI.");
                    return;
                }
                taxaMensal = (taxaCDI / 12) * percentualCDIComImposto;
            }
            let valorFinal = valorInicial;
            for (let i = 0; i < prazo; i++) {
                valorFinal = valorFinal * (1 + taxaMensal) + aporteMensal;
            }
            const ganhoTotal = valorFinal - valorInicial - (aporteMensal * prazo);
            const inflacaoAcumulada = Math.pow(1 + inflacao, prazo / 12) - 1;
            const valorFinalAjustado = valorFinal / (1 + inflacaoAcumulada);
            document.getElementById('resultValorInicial').textContent = valorInicial.toFixed(2);
            document.getElementById('resultAporteMensal').textContent = aporteMensal.toFixed(2);
            document.getElementById('resultPrazo').textContent = prazo;
            document.getElementById('resultTaxaRendimento').textContent = (taxaMensal * 100).toFixed(2);
            document.getElementById('resultValorFinal').textContent = valorFinal.toFixed(2);
            document.getElementById('resultGanhoTotal').textContent = ganhoTotal.toFixed(2);
            document.getElementById('resultInflacaoAcumulada').textContent = (inflacaoAcumulada * 100).toFixed(2);
            document.getElementById('resultValorFinalAjustado').textContent = valorFinalAjustado.toFixed(2);
            document.getElementById('results').style.display = 'block';
            // Comparações
            const taxaPoupanca = 0.005; // 0.5% ao mês
            const taxaCDB = (taxaCDI / 12) * percentualCDIComImposto;
            const taxaLCILCA = (taxaCDI / 12) * percentualCDISemImposto; // LCI/LCA sem IR
            let valorFinalPoupanca = valorInicial;
            let valorFinalCDB = valorInicial;
            let valorFinalLCILCA = valorInicial;
            for (let i = 0; i < prazo; i++) {
                valorFinalPoupanca = valorFinalPoupanca * (1 + taxaPoupanca) + aporteMensal;
                valorFinalCDB = valorFinalCDB * (1 + taxaCDB) + aporteMensal;
                valorFinalLCILCA = valorFinalLCILCA * (1 + taxaLCILCA) + aporteMensal;
            }
            // Aplicar imposto de renda regressivo no CDB
            let aliquotaIR;
            if (prazo <= 180) {
                aliquotaIR = 0.225; // 22.5%
            } else if (prazo <= 360) {
                aliquotaIR = 0.20; // 20%
            } else if (prazo <= 720) {
                aliquotaIR = 0.175; // 17.5%
            } else {
                aliquotaIR = 0.15; // 15%
            }
            const ganhoBrutoCDB = valorFinalCDB - valorInicial - (aporteMensal * prazo);
            const impostoCDB = ganhoBrutoCDB * aliquotaIR;
            const ganhoLiquidoCDB = ganhoBrutoCDB - impostoCDB;
            const valorFinalLiquidoCDB = valorFinalCDB - impostoCDB;
            document.getElementById('comparacaoPoupancaValorFinal').textContent = valorFinalPoupanca.toFixed(2);
            document.getElementById('comparacaoPoupancaGanhoTotal').textContent = (valorFinalPoupanca - valorInicial - (aporteMensal * prazo)).toFixed(2);
            document.getElementById('comparacaoCDBValorFinal').textContent = valorFinalLiquidoCDB.toFixed(2);
            document.getElementById('comparacaoCDBGanhoTotal').textContent = ganhoLiquidoCDB.toFixed(2);
            document.getElementById('comparacaoLCILCAValorFinal').textContent = valorFinalLCILCA.toFixed(2);
            document.getElementById('comparacaoLCILCAGanhoTotal').textContent = (valorFinalLCILCA - valorInicial - (aporteMensal * prazo)).toFixed(2);
            // Gráfico de Simulação
            const ctxSimulacao = document.getElementById('chartSimulacao').getContext('2d');
            new Chart(ctxSimulacao, {
                type: 'line',
                data: {
                    labels: Array.from({ length: prazo }, (_, i) => `Mês ${i + 1}`),
                    datasets: [{
                        label: 'Valor Acumulado',
                        data: Array.from({ length: prazo }, (_, i) => {
                            let valor = valorInicial;
                            for (let j = 0; j <= i; j++) {
                                valor = valor * (1 + taxaMensal) + aporteMensal;
                            }
                            return valor;
                        }),
                        borderColor: '#3498db',
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            // Gráfico de Comparações
            const ctxComparacoes = document.getElementById('chartComparacoes').getContext('2d');
            new Chart(ctxComparacoes, {
                type: 'bar',
                data: {
                    labels: ['Poupança', 'CDB', 'LCI/LCA'],
                    datasets: [{
                        label: 'Valor Final',
                        data: [valorFinalPoupanca, valorFinalLiquidoCDB, valorFinalLCILCA],
                        backgroundColor: ['#2ecc71', '#3498db', '#e74c3c']
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            // Laudo Comparativo
            const laudoComparativo = document.getElementById('laudoComparativo');
            if (valorFinalPoupanca > valorFinalLiquidoCDB && valorFinalPoupanca > valorFinalLCILCA) {
                laudoComparativo.textContent = "A poupança foi a opção mais vantajosa neste cenário.";
            } else if (valorFinalLiquidoCDB > valorFinalPoupanca && valorFinalLiquidoCDB > valorFinalLCILCA) {
                laudoComparativo.textContent = "O CDB foi a opção mais vantajosa neste cenário.";
            } else {
                laudoComparativo.textContent = "O LCI/LCA foi a opção mais vantajosa neste cenário.";
            }
            // Cálculo do valor necessário para atingir a meta
            const goalAmount = parseFloat(document.getElementById('goalAmount').value);
            const goalYears = parseFloat(document.getElementById('goalYears').value);
            const goalMonths = goalYears * 12;
            if (goalAmount && goalMonths) {
                const taxaMensalMeta = (taxaCDI / 12) * percentualCDISemImposto; // Usando LCI/LCA para cálculo da meta
                const valorNecessario = (goalAmount * taxaMensalMeta) / (Math.pow(1 + taxaMensalMeta, goalMonths) - 1);
                const valorNecessarioAjustado = valorNecessario * Math.pow(1 + inflacao, goalYears);
                document.getElementById('laudoMeta').textContent = `Para atingir a meta de R$ ${goalAmount.toFixed(2)} em ${goalYears} anos, considerando a rentabilidade do LCI/LCA e a inflação, você precisaria investir aproximadamente R$ ${valorNecessarioAjustado.toFixed(2)} mensalmente.`;
            } else {
                document.getElementById('laudoMeta').textContent = "Preencha os campos de meta financeira e prazo para calcular o valor necessário.";
            }
            // Exibir o percentual do CDI do CDB necessário para bater o LCI/LCA
            document.getElementById('laudoPercentualCDB').textContent = `Para o CDB ter o mesmo rendimento líquido do LCI/LCA, ele precisa render ${(percentualCDIComIRNecessario * 100).toFixed(2)}% do CDI.`;
        }
        document.getElementById('tipoRendimento').addEventListener('change', function() {
            const tipoRendimento = this.value;
            if (tipoRendimento === 'fixa') {
                document.getElementById('taxaFixaGroup').style.display = 'block';
                document.getElementById('cdiGroup').style.display = 'none';
            } else {
                document.getElementById('taxaFixaGroup').style.display = 'none';
                document.getElementById('cdiGroup').style.display = 'block';
            }
        });
       // Função para calcular a alíquota de IR do PGBL com base no período
       function calcularAliquotaIRPGBL(anos) {
           if (anos <= 2) return 0.35;
           if (anos <= 4) return 0.30;
           if (anos <= 6) return 0.20;
           if (anos <= 8) return 0.15;
            return 0.10; // Acima de 8 anos
       }
        // Função para calcular a alíquota de IR do CDB com base no período
       function calcularAliquotaIRCDB(meses) {
           if (meses <= 6) return 0.225; // 22,5%
            if (meses <= 12) return 0.20; // 20%
            if (meses <= 24) return 0.175; // 17,5%
            return 0.15; // 15% (acima de 24 meses)
        }
        function calcularPGBLCDB() {
            // Obter valores dos inputs
            const rendaTributavel = parseFloat(document.getElementById('rendaTributavel').value);
            const aporteInicial = parseFloat(document.getElementById('aporteInicial').value) || 0;
           const anos = parseInt(document.getElementById('anos').value);
            const cdi = parseFloat(document.getElementById('cdi').value) / 100;
            // Validar entradas
            if (isNaN(rendaTributavel) || rendaTributavel <= 0) {
                alert("Por favor, insira uma renda anual tributável válida.");
                return;
           }
            if (isNaN(anos) || anos <= 0) {
                alert("Por favor, insira um período de investimento válido.");
                return;
           }
           if (isNaN(cdi) || cdi <= 0) {
                alert("Por favor, insira uma taxa do CDI válida.");
                return;
           }
            // Constantes
            const aliquotaIR = 0.275; // 27,5%
            const aporteAnual = rendaTributavel * 0.12;
            // Inicializar variáveis
            let pgblSaldo = aporteInicial;
           let pgblDesembolso = aporteInicial;
            let cdbSaldo = aporteInicial;
            let cdbDesembolso = aporteInicial;
            // Limpar tabela de detalhes
            const tabelaDetalhes = document.getElementById('tabelaDetalhes').getElementsByTagName('tbody')[0];
           tabelaDetalhes.innerHTML = "";
            // Calcular acumulação ao longo dos anos
            for (let i = 1; i <= anos; i++) {
               // PGBL: No primeiro ano, não há restituição
               const restituicao = i === 1 ? 0 : aporteAnual * aliquotaIR;
                const aporteEfetivo = i === 1 ? aporteAnual : aporteAnual - restituicao;
                pgblDesembolso += aporteEfetivo;
                pgblSaldo = (pgblSaldo + aporteEfetivo + restituicao) * (1 + cdi);
                 // CDB: Aporte fixo anual (não há restituição)
                 cdbDesembolso += aporteAnual;
                cdbSaldo = (cdbSaldo + aporteAnual) * (1 + cdi);
                 // Adicionar linha na tabela de detalhes
                const row = tabelaDetalhes.insertRow();
                row.insertCell().innerText = i;
                row.insertCell().innerText = aporteEfetivo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                row.insertCell().innerText = restituicao.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                row.insertCell().innerText = pgblSaldo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                 row.insertCell().innerText = aporteAnual.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
               row.insertCell().innerText = cdbSaldo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }
           // Adicionar linha de totalização
           const rowTotal = tabelaDetalhes.insertRow();
            rowTotal.classList.add('total');
           rowTotal.insertCell().innerText = "Total";
           rowTotal.insertCell().innerText = pgblDesembolso.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
           rowTotal.insertCell().innerText = (pgblDesembolso - aporteInicial - aporteAnual * anos).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            rowTotal.insertCell().innerText = ""; // Saldo PGBL não é somado
            rowTotal.insertCell().innerText = cdbDesembolso.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            rowTotal.insertCell().innerText = ""; // Saldo CDB não é somado
           // Calcular IR no resgate
            const aliquotaPGBL = calcularAliquotaIRPGBL(anos);
            const pgblIR = pgblSaldo * aliquotaPGBL;
            const pgblLiquido = pgblSaldo - pgblIR;
            const meses = anos * 12; // Converter anos em meses
            const aliquotaCDB = calcularAliquotaIRCDB(meses);
           const cdbRendimentos = cdbSaldo - cdbDesembolso; // Rendimentos = Saldo - Aportes
            const cdbIR = cdbRendimentos * aliquotaCDB; // IR sobre os rendimentos
           const cdbLiquido = cdbSaldo - cdbIR; // Valor líquido após IR
             // Exibir resultados
            document.getElementById('pgblAcumulado').innerText = pgblSaldo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            document.getElementById('pgblDesembolso').innerText = pgblDesembolso.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            document.getElementById('pgblIR').innerText = pgblIR.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            document.getElementById('pgblLiquido').innerText = pgblLiquido.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            document.getElementById('cdbAcumulado').innerText = cdbSaldo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
           document.getElementById('cdbDesembolso').innerText = cdbDesembolso.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            document.getElementById('cdbIR').innerText = cdbIR.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
           document.getElementById('cdbLiquido').innerText = cdbLiquido.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            // Análise comparativa
            const diferencaLiquida = pgblLiquido - cdbLiquido;
            const totalRestituido = pgblDesembolso - aporteInicial - (aporteAnual * anos);
            const resultadoFinalAjustado = diferencaLiquida - totalRestituido;
            const rentabilidadePGBL = ((pgblLiquido - pgblDesembolso) / pgblDesembolso) * 100;
            const rentabilidadeCDB = ((cdbLiquido - cdbDesembolso) / cdbDesembolso) * 100;
             document.getElementById('diferencaLiquida').innerText = diferencaLiquida.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
             document.getElementById('totalRestituido').innerText = totalRestituido.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            document.getElementById('resultadoFinalAjustado').innerText = resultadoFinalAjustado.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
           document.getElementById('rentabilidadePGBL').innerText = rentabilidadePGBL.toFixed(2) + "%";
            document.getElementById('rentabilidadeCDB').innerText = rentabilidadeCDB.toFixed(2) + "%";
            // Mostrar resultados
            document.getElementById('resultados-pgbl-cdb').style.display = 'block';
        }
    </script>
</body>
</html>