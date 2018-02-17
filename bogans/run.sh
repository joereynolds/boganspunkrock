docker-compose down

docker-compose up --build -d --force-recreate php mysql

echo 'Once the containers are up, run ./after.sh'
