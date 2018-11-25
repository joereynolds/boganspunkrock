mysql_password=$(pwgen 12)
echo "Generating MySQL password in .env"
echo "MYSQL_PASSWORD=$mysql_password" > .env

# We want to force regeneration of this file all the time
rm -f ./app/config/parameters.yml

docker-compose down

# This fixes annoying cached environment variables and such.
# See here https://github.com/docker-library/mysql/issues/51
docker-compose rm -v

docker-compose up --build -d --force-recreate php mysql

rm -f ./env

echo '+------------------------------------------+'
echo '|Bogans is now available on port 5678.     |'
echo '|Once the containers are up, run ./after.sh|'
echo '|                                          |'
echo "|MYSQL PASSWORD: $mysql_password              |"
echo "|You won't see this password again.        |"
echo '+------------------------------------------+'

sleep 5

# Composer install
docker run --rm --interactive --tty --volume $PWD:/app composer install

# Change the permissions because Symfony 3 is a PITA with them.
docker exec bogans_php_1 chown -R www-data:www-data var

# Run our migrations so we have the structure we need
docker exec bogans_php_1 php bin/console doctrine:migrations:migrate

# Whilst we're at it, populate the tables with some fake data
docker exec bogans_php_1 php bin/console doctrine:fixtures:load

# Clear the cache for non-local dev
docker exec bogans_php_1 php bin/console cache:clear --env=prod
