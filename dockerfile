FROM richarvey/nginx-php-fpm:latest

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan key:generate --show

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 80
