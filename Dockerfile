# Use a imagem oficial do PHP com Apache
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Atualiza e instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libz-dev \
    && rm -rf /var/lib/apt/lists/*

# Instala o driver MongoDB 2.1.4
RUN pecl install mongodb-2.1.4 \
    && docker-php-ext-enable mongodb

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Copia os arquivos do projeto para o container
COPY . .

# Copia o Composer do container oficial do Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala as dependências do Composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb

# Expõe a porta 80
EXPOSE 80

# Comando para iniciar o Apache em primeiro plano
CMD ["apache2-foreground"]
