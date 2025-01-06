<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Investimentos</title>
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
        <h1>Simulador de Investimentos</h1>
       <!-- Simulação Global -->
        <section>
            <h2>Simulação Global</h2>
            <div class="form-group">
               <label for="aporteMensal">Aporte Mensal (R$):</label>
               <input type="number" id="aporteMensal" placeholder="Exemplo: 1000" value="0">
            </div>
             <div class="form-group">
               <label for="taxaMensal">Taxa Mensal (%):</label>
                <input type="number" id="taxaMensal" placeholder="Exemplo: 0.83" value="0">
           </div>
           <div class="form-group">
                <label for="quantidadeMeses">Quantidade de Meses:</label>
                <input type="number" id="quantidadeMeses" placeholder="Exemplo: 36" value="0">
            </div>
            <button onclick="calcularSimulacaoGlobal()">Simular</button>
             <div class="results">
               <p><strong>Valor Futuro Total: R$ <span id="valorFuturoGlobal">0.00</span></strong></p>
           </div>
        </section>
        <hr>
         <!-- Simulação Mensal -->
        <h2>Simulação Mensal (12 Meses)</h2>
        <button onclick="preencherTodosMeses()">Preencher todos os meses com o valor do primeiro mês</button>
        <button onclick="preencherTaxaAnualTodosMeses()">Preencher taxa anual do primeiro mês em todos os meses</button>
       <table id="simuladorInvestimentos" class="comparison-table">
            <thead>
                <tr>
                    <th>Mês</th>
                    <th>Valor Investido (R$)</th>
                    <th>Taxa Anual (%)</th>
                    <th>Taxa Mensal (%)</th>
                   <th>Número de Meses</th>
                   <th>Valor Futuro (R$)</th>
                </tr>
           </thead>
           <tbody>
                <!-- Linhas dos 12 meses -->
               <tr>
                    <td>Janeiro</td>
                    <td><input type="number" class="investido" value="0"></td>
                    <td><input type="number" class="taxaAnual" value="11.15"></td>
                   <td><span class="taxaMensal">0</span></td>
                    <td><span class="meses">1</span></td>
                    <td><span class="valorFuturo">0</span></td>
               </tr>
               <tr>
                    <td>Fevereiro</td>
                    <td><input type="number" class="investido" value="0"></td>
                    <td><input type="number" class="taxaAnual" value="11.15"></td>
                    <td><span class="taxaMensal">0</span></td>
                    <td><span class="meses">2</span></td>
                    <td><span class="valorFuturo">0</span></td>
               </tr>
                <tr>
                   <td>Março</td>
                    <td><input type="number" class="investido" value="0"></td>
                    <td><input type="number" class="taxaAnual" value="11.15"></td>
                   <td><span class="taxaMensal">0</span></td>
                   <td><span class="meses">3</span></td>
                    <td><span class="valorFuturo">0</span></td>
               </tr>
                <tr>
                    <td>Abril</td>
                   <td><input type="number" class="investido" value="0"></td>
                    <td><input type="number" class="taxaAnual" value="11.15"></td>
                    <td><span class="taxaMensal">0</span></td>
                   <td><span class="meses">4</span></td>
                    <td><span class="valorFuturo">0</span></td>
               </tr>
                <tr>
                    <td>Maio</td>
                   <td><input type="number" class="investido" value="0"></td>
                   <td><input type="number" class="taxaAnual" value="11.15"></td>
                    <td><span class="taxaMensal">0</span></td>
                   <td><span class="meses">5</span></td>
                   <td><span class="valorFuturo">0</span></td>
               </tr>
                <tr>
                   <td>Junho</td>
                   <td><input type="number" class="investido" value="0"></td>
                    <td><input type="number" class="taxaAnual" value="11.15"></td>
                   <td><span class="taxaMensal">0</span></td>
                    <td><span class="meses">6</span></td>
                   <td><span class="valorFuturo">0</span></td>
                </tr>
                <tr>
                    <td>Julho</td>
                    <td><input type="number" class="investido" value="0"></td>
                   <td><input type="number" class="taxaAnual" value="11.15"></td>
                    <td><span class="taxaMensal">0</span></td>
                   <td><span class="meses">7</span></td>
                    <td><span class="valorFuturo">0</span></td>
               </tr>
               <tr>
                    <td>Agosto</td>
                   <td><input type="number" class="investido" value="0"></td>
                    <td><input type="number" class="taxaAnual" value="11.15"></td>
                    <td><span class="taxaMensal">0</span></td>
                   <td><span class="meses">8</span></td>
                    <td><span class="valorFuturo">0</span></td>
               </tr>
                <tr>
                   <td>Setenbro</td>
                   <td><input type="number" class="investido" value="0"></td>
                   <td><input type="number" class="taxaAnual" value="11.15"></td>
                    <td><span class="taxaMensal">0</span></td>
                   <td><span class="meses">9</span></td>
                   <td><span class="valorFuturo">0</span></td>
                </tr>
                <tr>
                    <td>Outubro</td>
                    <td><input type="number" class="investido" value="0"></td>
                    <td><input type="number" class="taxaAnual" value="11.15"></td>
                    <td><span class="taxaMensal">0</span></td>
                   <td><span class="meses">10</span></td>
                    <td><span class="valorFuturo">0</span></td>
                </tr>
                 <tr>
                   <td>Novembro</td>
                    <td><input type="number" class="investido" value="0"></td>
                   <td><input type="number" class="taxaAnual" value="11.15"></td>
                    <td><span class="taxaMensal">0</span></td>
                   <td><span class="meses">11</span></td>
                    <td><span class="valorFuturo">0</span></td>
                </tr>
                <tr>
                    <td>Dezembro</td>
                   <td><input type="number" class="investido" value="0"></td>
                    <td><input type="number" class="taxaAnual" value="11.15"></td>
                   <td><span class="taxaMensal">0</span></td>
                    <td><span class="meses">12</span></td>
                    <td><span class="valorFuturo">0</span></td>
               </tr>
                <tr class="total">
                    <td><strong>Total</strong></td>
                   <td><span id="totalInvestido">0</span></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span id="totalFuturo">0</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Footer -->
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
         function calcularSimulacaoGlobal() {
            // Obtém os valores inseridos pelo usuário
            const aporteMensal = parseFloat(document.getElementById("aporteMensal").value) || 0;
           const taxaMensal = parseFloat(document.getElementById("taxaMensal").value) / 100 || 0;
            const quantidadeMeses = parseInt(document.getElementById("quantidadeMeses").value) || 0;
             // Verifica se os valores são válidos
           if (aporteMensal <= 0 || taxaMensal <= 0 || quantidadeMeses <= 0) {
               alert("Por favor, insira valores válidos para todos os campos.");
               return;
            }
            // Calcula o valor futuro somando os fluxos de caixa: PMT * (1 + i)^(n - t)
            let valorFuturo = 0;
           for (let t = 1; t <= quantidadeMeses; t++) {
                valorFuturo += aporteMensal * Math.pow(1 + taxaMensal, quantidadeMeses - t);
            }
             // Atualiza o valor futuro total no HTML
            document.getElementById("valorFuturoGlobal").textContent = valorFuturo.toFixed(2).replace('.', ',');
        }
         // Função para calcular o Simulador de Investimentos Mensal
        function calcularInvestimentos() {
            let totalInvestido = 0;
           let valorFuturoAnterior = 0;
            document.querySelectorAll("#simuladorInvestimentos tbody tr").forEach((row, index) => {
                const investidoInput = row.querySelector(".investido");
                if (!investidoInput) return; // Ignorar linha de totais
                const investido = parseFloat(investidoInput.value) || 0;
               const taxaAnual = parseFloat(row.querySelector(".taxaAnual").value) || 0;
                const taxaMensal = Math.pow(1 + taxaAnual / 100, 1 / 12) - 1;
                const meses = index + 1;
                // Cálculo do valor futuro acumulado
                const valorFuturo = (valorFuturoAnterior + investido) * (1 + taxaMensal);
               valorFuturoAnterior = valorFuturo;
               row.querySelector(".taxaMensal").textContent = (taxaMensal * 100).toFixed(2);
                row.querySelector(".meses").textContent = meses;
                row.querySelector(".valorFuturo").textContent = valorFuturo.toFixed(2);
                totalInvestido += investido;
           });
            // Atualiza o total investido e o total futuro
           document.getElementById("totalInvestido").textContent = totalInvestido.toFixed(2);
            document.getElementById("totalFuturo").textContent = valorFuturoAnterior.toFixed(2);
        }
        // Função para preencher todos os meses com o valor do primeiro mês
        function preencherTodosMeses() {
            const primeiroValor = parseFloat(document.querySelector(".investido").value) || 0;
           document.querySelectorAll(".investido").forEach(input => {
                input.value = primeiroValor;
            });
           calcularInvestimentos();
        }
        // Função para preencher a taxa anual do primeiro mês em todos os meses
        function preencherTaxaAnualTodosMeses() {
            const primeiraTaxaAnual = parseFloat(document.querySelector(".taxaAnual").value) || 0;
            document.querySelectorAll(".taxaAnual").forEach(input => {
                input.value = primeiraTaxaAnual;
           });
            calcularInvestimentos();
       }
       // Atualizar cálculos ao alterar valores
       document.querySelectorAll("input").forEach(input => {
           input.addEventListener("input", calcularInvestimentos);
       });
        // Calcular valores iniciais
        calcularInvestimentos();
    </script>
</body>
</html>