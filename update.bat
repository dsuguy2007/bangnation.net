git pull
php composer.phar update
php app/console cache:clear
php app/console cache:clear --env=prod
php app/console assetic:dump
php app/console assetic:dump --env=prod

