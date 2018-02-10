docker-compose down

docker-compose up --build --force-recreate php
docker exec bogans_php_1 composer install
