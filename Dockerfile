# Base PHP 8.3 com Apache
FROM php:8.3-apache

# Diretório de trabalho
WORKDIR /var/www/html

# Instala dependências do sistema e MongoDB driver
RUN apt-get update && apt-get install -y \
        git \
        unzip \
        libssl-dev \
        pkg-config \
        build-essential \
        sudo \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia arquivos do projeto
COPY src/ /var/www/html/src/
COPY public/ /var/www/html/public/
COPY composer.json /var/www/html/

# Composer install (ignora temporariamente a extensão MongoDB)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb

# Define DocumentRoot do Apache para public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expõe porta 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
