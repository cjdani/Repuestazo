#!/bin/bash

# Pernisos Laravel
echo "🔧 Fixing Laravel storage/cache permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

exec apache2-foreground

