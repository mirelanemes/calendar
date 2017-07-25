calendar
========

A Symfony project created on July 21, 2017, 7:15 pm.
# calendar

Includes
- Event Entity and yml ORM generated

- CRUD operations
- generated forms for frontend

Usage:

git clone -b dev https://github.com/mirelanemes/calendar.git

php composer.phar install

php bin/console doctrine:database:create - Creates the configured database

php bin/console doctrine:schema:create - Executes the SQL needed to generate the database schema

php bin/console server:run - Run project on localhost

Browse http://localhost:8000/event/

Documentation was generatid with apigen and can be found under /api folder