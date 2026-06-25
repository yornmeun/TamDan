# ---------------------------
# 1. PHP + Composer stage
# ---------------------------
FROM php:8.3-cli AS php

RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpq-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql zip intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction


# ---------------------------
# 2. Node build stage
# ---------------------------
COPY package*.json ./

RUN npm install --legacy-peer-deps

COPY . .

RUN npm run build


# ---------------------------
# 3. Final runtime image
# ---------------------------
FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql zip intl

COPY --from=php /var/www/html /var/www/html
COPY --from=node /app/public/build /var/www/html/public/build

WORKDIR /var/www/html

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=$PORT