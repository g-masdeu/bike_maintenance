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

# --- STAGE 3: PHP-FPM final (Contenedor de ejecución) ---
FROM php:8.2-fpm-alpine

# Dependencias y extensiones
# Añadido libpng-dev y libjpeg-turbo-dev por si manipulas imágenes de bicis
RUN apk update && apk add --no-cache \
    icu-libs git unzip libzip-dev oniguruma-dev \
    libpng-dev libjpeg-turbo-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql bcmath intl mbstring zip gd \
    && docker-php-ext-enable opcache

# Configurar directorio
WORKDIR /var/www/html

# Copiar archivos desde el builder (Tiene el código + vendor + public/build)
COPY --from=composer_builder /app /var/www/html

# Permisos críticos (Storage y Cache deben ser escribibles)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Cambiar al usuario www-data para seguridad
USER www-data

EXPOSE 9000
CMD ["php-fpm"]