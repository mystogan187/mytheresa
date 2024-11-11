#!/bin/bash

set -e

echo "Esperando a que MySQL esté listo en $DB_HOST..."

until nc -z -v -w30 $DB_HOST 3306; do
  echo "MySQL no está disponible aún, intentando de nuevo..."
  sleep 5
done

echo "MySQL está listo. Instalando dependencias..."

composer install --no-interaction --optimize-autoloader --prefer-dist

echo "Dependencias instaladas. Ajustando permisos..."

chown -R www-data:www-data /var/www/html/var
chmod -R 775 /var/www/html/var

echo "Permisos ajustados. Ejecutando migraciones si existen..."

if ls /var/www/html/migrations/*.php 1> /dev/null 2>&1; then
  php bin/console doctrine:migrations:migrate --no-interaction
else
  echo "No hay migraciones para ejecutar."
fi

echo "Iniciando PHP-FPM..."

php-fpm