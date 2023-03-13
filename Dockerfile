# Наследование от официального образа PHP
FROM php:8.1-fpm

# Обновление списка пакетов и установка зависимостей
RUN apt-get update && \
    apt-get install -y \
        git \
        curl \
        libzip-dev \
        zip \
        unzip \
        nginx \
        redis-server \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libonig-dev \
        mysql-server

# Установка расширений PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql pdo_pgsql zip \
    && pecl install redis \
    && docker-php-ext-enable redis

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копирование настроек nginx
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Cоздание директории для Laravel
RUN mkdir -p /var/www/html

# Копирование кода Laravel в контейнер
COPY . /var/www/html

# Установка зависимостей Laravel
WORKDIR /var/www/html
RUN composer install --no-scripts --no-interaction

# Установка зависимостей npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get update \
    && apt-get install -y gcc g++ make \
    && apt-get install -y nodejs \
    && npm install -g npm@8.19.2 \
    && npm install

#выдаем права на папку node_modules storage bootstrap/cache public
RUN chown -R www-data:www-data /var/www/html/node_modules \
    && chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/public \
    && chmod -R 775 /var/www/html/node_modules \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/public \
    && chmod -R 775 /var/www/html

# Компиляция статических файлов
RUN npm run build
RUN php artisan migrate --force

# Установка ключа приложения
RUN copy .env.example .env
RUN php artisan key:generate

# Открытие порта nginx
EXPOSE 80

# Запуск nginx и php-fpm
CMD service nginx start && php-fpm

RUN certbot certonly --webroot --webroot-path=/var/www/html/public -d qrder.kz -d www.qrder.kz
RUN service nginx restart
