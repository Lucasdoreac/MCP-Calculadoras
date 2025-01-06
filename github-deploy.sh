#!/bin/bash

echo "🚀 Iniciando deploy para GitHub..."

# Configurar Git se necessário
if [ -z "$(git config --global user.name)" ]; then
    echo "📝 Configurando nome do usuário Git..."
    git config --global user.name "Lucas Cardoso"
fi

if [ -z "$(git config --global user.email)" ]; then
    echo "📝 Configurando email do Git..."
    git config --global user.email "lucascardosodeoliveira9@gmail.com"
fi

# Criar .gitignore
echo "📄 Criando .gitignore..."
cat > .gitignore << EOL
# PHP
/vendor/
composer.phar
*.log

# IDE
.idea/
.vscode/
*.swp
*.swo

# Sistema
.DS_Store
Thumbs.db

# Ambiente
.env
.env.local
.env.*.local

# Dependências
/node_modules/
npm-debug.log
yarn-debug.log
yarn-error.log

# Cache
*.cache
EOL

# Remover configuração Git existente se houver
echo "🧹 Limpando configurações Git anteriores..."
rm -rf .git

# Inicializar Git
echo "🎯 Inicializando repositório Git..."
git init

# Adicionar arquivos
echo "📦 Adicionando arquivos ao Git..."
git add .

# Criar commit inicial
echo "💾 Criando commit inicial..."
git commit -m "feat: Implementa calculadoras de investimento com análises detalhadas

- Adiciona simulador principal de investimentos
- Implementa calculadora PGBL vs CDB
- Adiciona análise de risco e retorno
- Inclui gráficos interativos
- Implementa recomendações personalizadas"

# Adicionar remote do GitHub
echo "🔗 Conectando ao GitHub..."
git remote add origin https://github.com/Lucasdoreac/MCP-Calculadoras.git

# Mudar para branch main
echo "🔄 Configurando branch main..."
git branch -M main

# Forçar push para GitHub (use com cuidado!)
echo "⬆️ Enviando arquivos para GitHub..."
git push -f origin main

echo "✅ Deploy concluído com sucesso!"
echo "🌐 Acesse: https://github.com/Lucasdoreac/MCP-Calculadoras"