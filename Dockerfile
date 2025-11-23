# Stage 0: PHP + Apache
FROM php:8.3-apache

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    pkg-config \
    libonig-dev \
    && docker-php-ext-install pdo

# Instala o driver MongoDB compatível (2.1.4)
RUN pecl install mongodb-2.1.4 \
    && docker-php-ext-enable mongodb

# Habilita mod_rewrite no Apache
RUN a2enmod rewrite

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia todo o projeto
COPY . .

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala dependências do PHP via Composer
RUN composer install --no-dev --optimize-autoloader

# Expõe porta do Apache
EXPOSE 80

# Comando padrão para rodar o Apache
CMD ["apache2-foreground"]
