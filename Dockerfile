FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev zip \
    libonig-dev libxml2-dev

# Install PHP extensions (IMPORTANT)
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    bcmath \
    zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www

# Copy files
COPY . .

# Install dependencies WITHOUT scripts (important fix)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Now run Laravel commands manually
RUN php artisan config:clear || true
RUN php artisan cache:clear || true

# Fix permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 10000

# Start server
CMD php -S 0.0.0.0:10000 -t public