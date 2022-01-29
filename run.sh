docker-compose down
docker-compose rm -v

# Ignoring platform reqs here because the php version in the composer container is different
# to the one inside our containers
docker run --rm --interactive --tty --volume $PWD:/app composer install --ignore-platform-reqs
docker-compose up --force-recreate --build

# change this to a docker healthcheck
echo 'Once containers are up, run ./after.sh'
