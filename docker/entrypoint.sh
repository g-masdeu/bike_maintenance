#!/bin/sh
set -e

# Copiar .env si no existe
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generar APP_KEY si no existe
php artisan key:generate --force

# Ejecutar migraciones
php artisan migrate --force

# Cachear configuración y rutas
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

exec "$@"
