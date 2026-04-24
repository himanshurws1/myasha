FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev zip \
    && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# 🔥 Laravel cache clear
RUN php artisan config:clear && php artisan cache:clear && php artisan view:clear

# 🔥 permissions fix (VERY IMPORTANT)
RUN chmod -R 775 storage bootstrap/cache

# optional but useful
EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=$PORT