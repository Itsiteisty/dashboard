# Escolhe a imagem base com PHP 8.3 e Apache
FROM php:8.3-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Instala a extensão MongoDB para PHP
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Copia o virtual host do Apache (opcional, se precisar configurar)
# COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Expõe a porta do Apache
EXPOSE 80

# Inicializa o Apache em foreground
CMD ["apache2-foreground"]
