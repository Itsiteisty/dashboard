# Use official PHP 8.2 Apache image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and MongoDB extension
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && apt-get clean

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY public/ /var/www/html/

# Copy Composer from official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
# --ignore-platform-reqs evita erros de versão PHP/extensão
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
