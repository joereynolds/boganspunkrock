docker-compose down
docker-compose rm -v

docker-compose up

./console.sh doctrine:migrations:migrate

echo 'bogans is now available on localhost:5678'
