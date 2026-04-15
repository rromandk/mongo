#!/bin/sh
# entrypoint.sh
cd /var/www
# Ajustar permisos para directorios de Laravel
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache

# Ejecutar el comando original
exec "$@"