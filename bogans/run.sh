echo "Generating MySQL password in .env"
echo "MYSQL_PASSWORD=$(pwgen 12)" > .env

docker-compose down

# This fixes annoying cached environment variables and such.
# See here https://github.com/docker-library/mysql/issues/51
docker-compose rm -v

docker-compose up --build -d --force-recreate php mysql

echo '+------------------------------------------+'
echo '|Visit localhost:5678 for your bogans site.|'
echo '|Once the containers are up, run ./after.sh|'
echo '+------------------------------------------+'
