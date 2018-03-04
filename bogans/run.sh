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

