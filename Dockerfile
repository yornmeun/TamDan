FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        zip \
        intl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy FULL project FIRST (important fix)
COPY . .

# Debug (optional - you can remove later)
RUN ls -R app/Helpers || true

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel optimization (safe)
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true
RUN php artisan event:clear || true

# Node dependencies + build Vite
COPY package*.json ./

RUN npm install --legacy-peer-deps

COPY . .

RUN npm run build

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=$PORT