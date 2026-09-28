# Base image PHP 8.3 dengan Apache
FROM php:8.3-apache

# Set direktori kerja
WORKDIR /var/www/html

# Install dependencies sistem yang diperlukan (termasuk libpq-dev untuk PostgreSQL)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP (PostgreSQL, MySQL, Zip, GD, dll.)
RUN docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql mbstring exif pcntl bcmath gd zip

# Aktifkan mod_rewrite Apache untuk routing Laravel
RUN a2enmod rewrite

# Ubah DocumentRoot Apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Salin Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin seluruh kode proyek ke dalam container
COPY . .

# Install dependencies PHP & Node.js
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build

# Atur permission folder storage dan bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Buat script entrypoint untuk migrasi otomatis saat container menyala
RUN echo '#!/bin/sh\nphp artisan config:clear\nphp artisan migrate --force\nexec apache2-foreground' > /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80
EXPOSE 80

# Jalankan entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
