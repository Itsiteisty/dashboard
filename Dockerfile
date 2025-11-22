FROM php:8.2-apache

WORKDIR /var/www/html

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

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json /var/www/html/
COPY src/ /var/www/html/src/
COPY public/ /var/www/html/

# Composer install ignorando ext-mongodb temporariamente
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb

RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
