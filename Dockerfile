# Base image: PHP 8.2 + Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Instala dependências do sistema e extensão MongoDB
RUN apt-get update && apt-get install -y \
        git \
        unzip \
        libssl-dev \
        pkg-config \
        build-essential \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copia Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia arquivos do projeto (sem composer.lock)
COPY composer.json /var/www/html/
COPY src/ /var/www/html/src/
COPY public/ /var/www/html/

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Configura Apache para index.php
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
