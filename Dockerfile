# Base PHP 8.2 com Apache
FROM php:8.2-apache

# Diretório de trabalho
WORKDIR /var/www/html

# Instala dependências e MongoDB
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

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia arquivos do projeto
# src/ fica acima de public/
COPY src/ /var/www/html/src/
COPY public/ /var/www/html/public/

# Define DocumentRoot do Apache para public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Instala dependências PHP via composer (ignora ext-mongodb no build)
COPY composer.json /var/www/html/
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expõe porta 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
