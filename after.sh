echo 'yes' | docker-compose run --rm php ./bin/console doctrine:migrations:migrate

echo 'bogans is now available on localhost:5678'
