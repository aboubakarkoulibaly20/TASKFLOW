#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --optimize-autoloader

# On ne génère la clé que si elle n'existe pas déjà
if [ -z "$APP_KEY" ]; then
  php artisan key:generate
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache