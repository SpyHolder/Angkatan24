# Gunakan image resmi PHP dengan ekstensi yang dibutuhkan Laravel
FROM php:8.3-fpm

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set Workdir
WORKDIR /var/www

# Salin file project
COPY . .

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Jalankan migrasi database
RUN php artisan key:generate && php artisan migrate --force

# Jalankan Laravel menggunakan PHP-FPM
CMD ["php-fpm"]