docker-compose down
docker-compose rm -v

docker-compose up --force-recreate --build


# change this to a docker healthcheck
echo 'Once containers are up, run ./after.sh'
