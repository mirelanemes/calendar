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

Perform some tests with Postman: https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop
GET http://localhost:8001/app_dev.php/events =>
[
    {
        "id": 2,
        "description": "Desc",
        "start": "2011-06-05T14:15:00+0400",
        "end": "2011-06-05T14:30:00+0400",
        "location": "Cluj"
    }
]

POST
http://127.0.0.1:8001/app_dev.php/events
    {
        "description": "Desc",
        "start": "2011-06-05T14:15:00+0400",
        "end": "2011-06-05T14:30:00+0400",
        "location": "Cluj"
    }
    
PUT
http://192.168.14.248:8000/calendar/web/app_dev.php/events/1

    {
        "description":"Desc",
        "start": "2011-06-05T14:15:00+0400",
        "end": "2011-06-05T14:30:00+0400",
        "location": "Cluj"
    }
    
    
    PATCH
    
    http://127.0.0.1:8001/app_dev.php/events/1
    
    {
        "location": "Cluj Napoca"
    }
