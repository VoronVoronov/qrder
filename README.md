docker-compose run certbot certonly --webroot --webroot-path=/var/www/html/public -d qrder.kz -d www.qrder.kz

docker-compose restart nginx

docker-compose exec app composer install

docker-compose exec app npm install

docker-compose exec app php artisan key:generate

docker-compose exec app php artisan migrate

docker-compose exec app php artisan db:seed
