#!/bin/bash

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Função para input da branch
read -p "💭 Digite o nome da branch (deixe em branco para 'main'): " branch_name
branch_name=${branch_name:-main}

echo -e "${BLUE}🚀 Iniciando deploy para branch '$branch_name'...${NC}"

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

# Verificar se já existe um repositório Git
if [ -d ".git" ]; then
    echo -e "${BLUE}📂 Repositório Git encontrado${NC}"
    
    # Verificar se a branch já existe localmente
    if git show-ref --verify --quiet refs/heads/$branch_name; then
        echo -e "${BLUE}🔄 Checkout para branch '$branch_name'${NC}"
        git checkout $branch_name
    else
        echo -e "${BLUE}🌱 Criando nova branch '$branch_name'${NC}"
        git checkout -b $branch_name
    fi
else
    # Inicializar Git
    echo -e "${BLUE}🎯 Inicializando novo repositório Git...${NC}"
    git init
    git checkout -b $branch_name
fi

# Adicionar arquivos
echo -e "${BLUE}📦 Adicionando arquivos ao Git...${NC}"
git add .

# Solicitar mensagem de commit
read -p "💬 Digite a mensagem do commit (deixe em branco para mensagem padrão): " commit_message
commit_message=${commit_message:-"feat: Atualiza calculadoras de investimento"}

# Criar commit
echo -e "${BLUE}💾 Criando commit...${NC}"
git commit -m "$commit_message"

# Verificar se o remote origin já existe
if git remote | grep -q "^origin$"; then
    echo -e "${BLUE}🔄 Remote origin já existe${NC}"
else
    echo -e "${BLUE}🔗 Adicionando remote origin...${NC}"
    git remote add origin https://github.com/Lucasdoreac/MCP-Calculadoras.git
fi

# Perguntar se deve forçar o push
read -p "❓ Deseja forçar o push? (s/N): " force_push
force_push=${force_push:-n}

# Enviar para GitHub
echo -e "${BLUE}⬆️ Enviando arquivos para GitHub...${NC}"
if [[ $force_push =~ ^[Ss]$ ]]; then
    echo -e "${RED}⚠️  Atenção: Fazendo force push...${NC}"
    git push -f origin $branch_name
else
    # Tentar pull primeiro
    echo -e "${BLUE}🔄 Sincronizando com o repositório remoto...${NC}"
    if git pull origin $branch_name --no-rebase; then
        git push origin $branch_name
    else
        echo -e "${RED}❌ Erro ao sincronizar. Você pode:${NC}"
        echo "1. Usar force push (cuidado: isso sobrescreverá o conteúdo remoto)"
        echo "2. Resolver os conflitos manualmente"
        read -p "Escolha uma opção (1/2): " conflict_option
        
        if [ "$conflict_option" = "1" ]; then
            echo -e "${RED}⚠️  Realizando force push...${NC}"
            git push -f origin $branch_name
        else
            echo -e "${BLUE}🔧 Por favor, resolva os conflitos manualmente e tente novamente${NC}"
            exit 1
        fi
    fi
fi

echo -e "${GREEN}✅ Deploy concluído com sucesso!${NC}"
echo -e "${GREEN}🌐 Acesse: https://github.com/Lucasdoreac/MCP-Calculadoras/tree/$branch_name${NC}"