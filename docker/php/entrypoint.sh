#!/bin/bash

# Establecer permisos correctos para Laravel
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Re-asegurar permisos para todas las subcarpetas de storage/app/public
chown -R www-data:www-data /var/www/html/storage/app/public
chmod -R 775 /var/www/html/storage/app/public

exec apache2-foreground

