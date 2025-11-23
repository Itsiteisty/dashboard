# Stage 0: Base PHP + Apache
FROM php:8.3-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libssl-dev \
    && docker-php-ext-install zip

# Instala o driver MongoDB compatível com PHP
RUN pecl install mongodb-1.21.3 \
    && docker-php-ext-enable mongodb

# Ativa módulos do Apache
RUN a2enmod rewrite

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala dependências do Composer (ignora plataforma se necessário)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb

# Expõe a porta 80
EXPOSE 80

# Comando para rodar o Apache em foreground
CMD ["apache2-foreground"]
