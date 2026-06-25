FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev \
    ca-certificates gnupg

# Install Node.js + npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Node dependencies + build Vite
RUN npm install
RUN npm run build

RUN chmod -R 775 storage bootstrap/cache

RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true
RUN php artisan event:clear || true

EXPOSE 10000

CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 10000