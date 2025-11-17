FROM php:8.3-fpm

# Install system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zlib1g-dev libicu-dev \
    libonig-dev curl && \
    docker-php-ext-install pdo pdo_pgsql mbstring zip intl

# Set working directory
WORKDIR /var/www

# Copy composer.json & composer.lock first
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Copy the rest of the files
COPY . .

# Then run artisan commands
RUN php artisan config:cache

# Install dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Create storage folders
RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs && \
    chown -R www-data:www-data storage bootstrap/cache

# Expose FPM port
EXPOSE 9000

# Start PHP-FPM (long-running)
CMD ["php-fpm"]
