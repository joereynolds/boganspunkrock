docker-compose down
docker-compose rm -v

docker-compose up --force-recreate --build
docker run --rm --interactive --tty --volume $PWD:/app composer install

# change this to a docker healthcheck
echo 'Once containers are up, run ./after.sh'
