FROM php:8.2-fpm

# Dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev libzip-dev zip unzip git curl libonig-dev

# Extensions PHP pour Laravel & MariaDB
RUN docker-php-ext-install pdo_mysql mbstring zip gd

# On récupère Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Installation des bibliothèques PHP
RUN composer install --no-dev --optimize-autoloader

# Droits d'écriture pour Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000