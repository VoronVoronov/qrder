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
        libonig-dev

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

# Копирование кода Laravel в контейнер
COPY . /var/www/html

# Установка зависимостей Laravel
WORKDIR /var/www/html
RUN composer install --no-scripts --no-interaction

# Установка зависимостей npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
RUN sudo apt-get install -y nodejs

RUN apt-get update && apt-get install -g npm@8.19.2 && npm install && npm run dev

# Открытие порта nginx
EXPOSE 80

# Запуск nginx и php-fpm
CMD service nginx start && php-fpm
