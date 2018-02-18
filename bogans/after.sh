# This needs to be ran after run.sh (hence the name).
# We can't really do it in run.sh because we don't
# know when a container is really 'up'
# Once you think it's up, run this.

# Change the permissions because Symfony 3 is a PITA with them.
docker exec bogans_php_1 chown -R www-data:www-data var

# Run our migrations so we have the structure we need
docker exec bogans_php_1 php bin/console doctrine:migrations:migrate

# Whilst we're at it, populate the tables with some fake data
docker exec bogans_php_1 php bin/console doctrine:fixtures:load




