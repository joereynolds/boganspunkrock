docker-compose down

docker-compose up -d php
docker exec bogans_php_1 composer install
