#!/bin/bash

# Script de inicialização para ambiente de desenvolvimento

echo "🚀 Iniciando ambiente de desenvolvimento..."

# Verificar se o arquivo .env existe
if [ ! -f .env ]; then
    echo "📄 Criando arquivo .env..."
    cp .env.example .env
fi

# Subir os containers
echo "🐳 Subindo containers Docker..."
docker-compose -f docker-compose-dev.yml up -d

# Aguardar MySQL estar pronto
echo "⏳ Aguardando MySQL estar pronto..."
sleep 10

# Executar comandos Laravel dentro do container
echo "🔧 Configurando Laravel..."
docker-compose -f docker-compose-dev.yml exec app composer install
#docker-compose -f docker-compose-dev.yml exec app php artisan key:generate
#docker-compose -f docker-compose-dev.yml exec app php artisan config:cache
#docker-compose -f docker-compose-dev.yml exec app php artisan route:cache
#docker-compose -f docker-compose-dev.yml exec app php artisan view:cache

# Rodar migrações
echo "📊 Executando migrações..."
docker-compose -f docker-compose-dev.yml exec app php artisan migrate --force

echo "✅ Ambiente pronto!"
echo "🌐 Aplicação: http://localhost:8080"
echo "🗄️  PHPMyAdmin: http://localhost:8081"
echo "📝 Para parar: docker-compose -f docker-compose-dev.yml down"
