# Imagem base PHP + Apache
FROM php:8.3-apache

# Instala dependências e ferramentas
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql

# Instala o driver MongoDB compatível
RUN pecl install mongodb-2.1.4 \
    && docker-php-ext-enable mongodb

# Ativa mod_rewrite do Apache
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o código
COPY . .

# Copia Composer do container oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Expõe a porta do Apache
EXPOSE 80
