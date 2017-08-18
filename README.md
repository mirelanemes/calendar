calendar
========

A Symfony project created on July 21, 2017, 7:15 pm.
# calendar

- Event Entity and yml ORM generated
- added some rest apis documented in api.html file

Usage:

git clone -b dev https://github.com/mirelanemes/calendar.git  

composer update
composer install

php bin/console doctrine:database:create - Creates the configured database

php bin/console doctrine:schema:create - Executes the SQL needed to generate the database schema

php bin/console server:run - Run project on localhost

GET http://localhost:8001/app_dev.php/events
