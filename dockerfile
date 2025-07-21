FROM php:8.3-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev libicu-dev g++ \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Set Git safe directory
RUN git config --global --add safe.directory /var/www/html

# Copy Apache vhost config
COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copy project files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80