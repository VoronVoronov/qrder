FROM laravelsail/php81-composer:latest

# Install NPM v8.19.2 and Node.js v16.15.0
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@8.19.2 \
    && apt-get update  \
    && apt-get install -y git zip unzip libzip-dev

#Install PHP 8.1 and PHP extensions and composer
RUN apt-get update && add-apt-repository -y ppa:ondrej/php

#Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');" && \
    php composer.phar install

# Copy the application code
COPY . /var/www/html

# Install application dependencies
RUN composer install --optimize-autoloader --no-dev && \
    npm install && \
    npm run build

# Set the working directory
WORKDIR /var/www/html
