Project: MyWebHealth

Application de gestion de santé migrée de PHP 7.3 vers PHP 8.2 et entièrement dockerisée. Stack : Laravel, MariaDB, Docker Compose. Installation : > 1. docker-compose up -d 2. docker-compose exec app composer install 3. docker-compose exec app php artisan migrate