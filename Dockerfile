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

# 2. Apache configs + document root.
RUN echo "ServerName laravel-app.local" >> /etc/apache2/apache2.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite headers

# 4. Start with base PHP config, then add extensions.
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install \
    pdo_mysql

#   Let users upload to the profile_pics dir
RUN chmod 777 -R /var/www/html/public/profile_pics

# Install project dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate application key
RUN php artisan key:generate


# Set working directory
WORKDIR /var/www/html/public

# Set folder permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/images
