# Docker Setup - Kredito MCP

Este projeto inclui uma configuração Docker completa com PHP 8.4, NGINX, MySQL e Redis para desenvolvimento.

## 🚀 Início Rápido

### 1. Preparar o ambiente

```bash
# Copiar arquivo de ambiente
cp .env.example .env

# Configurar variáveis de banco de dados no .env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=kredito_mcp
DB_USERNAME=root
DB_PASSWORD=password
```

### 2. Subir o ambiente

```bash
# Subir containers
docker-compose -f docker-compose-dev.yml up -d

# Ou usar o script de inicialização
./docker/scripts/start.sh
```

### 3. Configurar Laravel

```bash
# Instalar dependências
docker-compose -f docker-compose-dev.yml exec app composer install

# Gerar chave da aplicação
docker-compose -f docker-compose-dev.yml exec app php artisan key:generate

# Executar migrações
docker-compose -f docker-compose-dev.yml exec app php artisan migrate

# Limpar cache
docker-compose -f docker-compose-dev.yml exec app php artisan config:cache
docker-compose -f docker-compose-dev.yml exec app php artisan route:cache
docker-compose -f docker-compose-dev.yml exec app php artisan view:cache
```

## 📋 Serviços Disponíveis

| Serviço | URL | Porta |
|---------|-----|-------|
| Aplicação Laravel | http://localhost:8080 | 8080 |
| PHPMyAdmin | http://localhost:8081 | 8081 |
| MySQL | localhost:3306 | 3306 |
| Redis | localhost:6379 | 6379 |

## 🔧 Comandos Úteis

```bash
# Ver logs dos containers
docker-compose -f docker-compose-dev.yml logs -f

# Acessar container da aplicação
docker-compose -f docker-compose-dev.yml exec app bash

# Executar comandos Artisan
docker-compose -f docker-compose-dev.yml exec app php artisan [comando]

# Executar Composer
docker-compose -f docker-compose-dev.yml exec app composer [comando]

# Parar containers
docker-compose -f docker-compose-dev.yml down

# Parar e remover volumes
docker-compose -f docker-compose-dev.yml down -v
```

## 📁 Estrutura de Arquivos Docker

```
docker/
├── nginx/
│   ├── nginx.conf          # Configuração principal do NGINX
│   └── default.conf        # Virtual host do Laravel
├── supervisor/
│   └── supervisord.conf    # Configuração do Supervisor
├── scripts/
│   ├── start.sh           # Script de inicialização
│   └── stop.sh            # Script para parar
└── README.md              # Este arquivo
```

## 🐛 Troubleshooting

### Erro de permissão
```bash
# Corrigir permissões
docker-compose -f docker-compose-dev.yml exec app chown -R www-data:www-data /var/www/html/storage
docker-compose -f docker-compose-dev.yml exec app chown -R www-data:www-data /var/www/html/bootstrap/cache
```

### Limpar cache do Laravel
```bash
docker-compose -f docker-compose-dev.yml exec app php artisan config:clear
docker-compose -f docker-compose-dev.yml exec app php artisan route:clear
docker-compose -f docker-compose-dev.yml exec app php artisan view:clear
docker-compose -f docker-compose-dev.yml exec app php artisan cache:clear
```

### Reconstruir containers
```bash
docker-compose -f docker-compose-dev.yml down
docker-compose -f docker-compose-dev.yml build --no-cache
docker-compose -f docker-compose-dev.yml up -d
```

## 🔒 Produção

Para produção, utilize um arquivo `docker-compose.prod.yml` separado com:
- Variáveis de ambiente seguras
- Volumes de produção
- Configuração de SSL
- Backup automático do banco
- Monitoramento
