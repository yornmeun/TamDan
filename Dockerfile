FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    gnupg \
    ca-certificates \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        zip \
        intl

# Verify installation
RUN node -v
RUN npm -v

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN ls -R app/Helpers || true

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN npm install

RUN npm run build

# Laravel optimization
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true
RUN php artisan event:clear || true

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=$PORT