# Use PHP 8.4 FPM como base
FROM php:8.4-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    libssl-dev \
    libbrotli-dev \
    pkg-config \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP incluindo Swoole
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip sockets intl

# Instalar Swoole
RUN pecl install swoole \
    && docker-php-ext-enable swoole

RUN curl -LO https://github.com/DataDog/dd-trace-php/releases/latest/download/datadog-setup.php && \
    php datadog-setup.php --php-bin=all

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www/html


COPY docker/integrated/nginx/default.conf /etc/nginx/sites-available/default

COPY docker/integrated/nginx/nginx.conf /etc/nginx/nginx.conf

COPY docker/integrated/start-container /usr/local/bin/start-container

RUN chmod +x /usr/local/bin/start-container


COPY docker/integrated/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copiar arquivos do projeto
COPY . /var/www/html
# Instalar dependências do Composer
#RUN composer install --no-dev --optimize-autoloader

RUN set -x \
    && sed -i '/user www-data;/d' /etc/nginx/nginx.conf \
    && sed -i 's,/run/nginx.pid,/tmp/nginx.pid,' /etc/nginx/nginx.conf \
    && sed -i "/^http {/a \    proxy_temp_path /tmp/proxy_temp;\n    client_body_temp_path /tmp/client_temp;\n    fastcgi_temp_path /tmp/fastcgi_temp;\n    uwsgi_temp_path /tmp/uwsgi_temp;\n    scgi_temp_path /tmp/scgi_temp;\n" /etc/nginx/nginx.conf \
    && sed -i 's/access\.log = \/proc\/self\/fd\/2/access\.log = \/proc\/self\/fd\/1/' /usr/local/etc/php-fpm.d/docker.conf \
    && sed -i 's/pm.max_children = 64/pm.max_children = 120/g;' /usr/local/etc/php-fpm.d/www.conf

RUN set -x \
    && mkdir -p /var/cache/nginx \
    && chown -Rv 1000:0 /var/cache/nginx \
    && chmod -R g+w /var/cache/nginx \
    && chown -Rv 1000:0 /etc/nginx \
    && chmod -R g+w /etc/nginx \
    && touch /tmp/nginx.pid \
    && mkdir -p /tmp/proxy_temp \
    && mkdir -p /tmp/client_temp \
    && mkdir -p /tmp/scgi_temp \
    && mkdir -p /tmp/framework/sessions \
    && mkdir -p /tmp/framework/cache/data \
    && mkdir -p /tmp/framework/views \
    && chown -Rv 1000:0 /tmp/proxy_temp \
    && chown -Rv 1000:0 /tmp/client_temp \
    && chown -Rv 1000:0 /tmp/scgi_temp \
    && chown -Rv 1000:0 /tmp/framework/sessions \
    && chown -Rv 1000:0 /tmp/framework/cache/data \
    && chown -Rv 1000:0 /tmp/framework/views \
    && chown -Rv 1000:0 /tmp/nginx.pid \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stdout /var/log/nginx/error.log

USER 0

# Expor portas
EXPOSE 80

ENTRYPOINT ["start-container"]



