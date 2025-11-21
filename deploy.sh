#!/bin/bash
set -e
cd /var/www/ittour || exit 1

mkdir -p bootstrap/cache
mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views

sudo chown -R root:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

if [ ! -f storage/logs/laravel.log ]; then
    touch storage/logs/laravel.log
fi
sudo chown root:www-data storage/logs/laravel.log
sudo chmod 664 storage/logs/laravel.log

composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
sudo systemctl reload php8.2-fpm