#!/bin/bash

# Script para parar o ambiente de desenvolvimento

echo "🛑 Parando ambiente de desenvolvimento..."

# Parar e remover containers
docker-compose -f docker-compose-dev.yml down

echo "✅ Ambiente parado!"
echo "💡 Para remover volumes também: docker-compose -f docker-compose-dev.yml down -v"
