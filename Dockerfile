FROM php:8.2.6-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip

# Install Composer 2.6
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install additional PHP extensions if needed
# Example: RUN docker-php-ext-install pdo_mysql

# Copy your Laravel project files
COPY . /var/www/html


RUN composer require laravel/ui
# Install project dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate application key
RUN php artisan key:generate

# Set working directory
WORKDIR /var/www/html/public

# Set folder permissions if necessary
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/mysql
