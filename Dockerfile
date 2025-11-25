# --- STAGE 1: Build de Node (Assets) ---
FROM node:20-alpine AS node_builder
WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# --- STAGE 2: PHP Dependencies ---
FROM composer:2 AS composer_builder
WORKDIR /app
COPY --from=node_builder /app /app
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

# --- STAGE 3: PHP-FPM final ---
FROM php:8.2-fpm-alpine

# Dependencias y extensiones
RUN apk update && apk add --no-cache \
    icu sqlite-libs git unzip libzip-dev oniguruma-dev \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev sqlite-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql pdo_sqlite bcmath intl mbstring zip \
    && docker-php-ext-enable opcache \
    && apk del .build-deps

WORKDIR /var/www/html

COPY --from=composer_builder /app /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Usuario no root
USER www-data

EXPOSE 9000
