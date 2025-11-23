FROM php:8.3-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip libssl-dev libcurl4-openssl-dev pkg-config libz-dev \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install mongodb-2.1.4 \
    && docker-php-ext-enable mongodb

RUN a2enmod rewrite

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb

EXPOSE 80

CMD ["apache2-foreground"]
