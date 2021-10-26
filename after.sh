echo 'yes' | docker-compose run --rm php ./bin/console doctrine:migrations:migrate;
./create-seed-data.sql

echo 'bogans is now available on localhost:5678'
