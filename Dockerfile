FROM laravelsail/php81-composer:latest

# Install NPM and Node.js
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@8.19.2

# Copy the application code
COPY . /var/www/html

# Install application dependencies
RUN composer install --optimize-autoloader --no-dev && \
    npm install && \
    npm run prod

# Set the working directory
WORKDIR /var/www/html
