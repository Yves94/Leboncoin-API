# Exercice API_v3

System that allows a user to create / edit / delete / retrieve an announcement with Symfony 4.2 and MySQL.

NOT WORKING

## Before Launch

Run composer install and load database.
Load user with this command :
```
php bin/console doctrine:fixtures:load
```

## Urls

* http://127.0.0.1:8000/api/announcement
* http://127.0.0.1:8000/api/announcement/:id
* http://127.0.0.1:8000/api/announcement/new
* http://127.0.0.1:8000/api/announcement/edit/:id
* http://127.0.0.1:8000/api/announcement/remove/:id

## JSON Data

Announcement with a job
```
{"title": "Exemple title", "description": "Exemple description", "category": "job", "salary": 1000, "contract": "CDD"}
```

Announcement with a vehicle
```
{"title": "Exemple title", "description": "Exemple description", "category": "vehicle", "price": "25000", "fuelType": "E10"}
```

Announcement with a realEstate
```
{"title": "Exemple title", "description": "Exemple description", "category": "realEstate", "price": "25000", "area": 50}
```

## Sample with Curl 

```
    curl http://127.0.0.1:8000/api/announcement -H "Accept: application/json" -X POST -u john.doe@symfony.com:admin --data '{"title": "Exemple title", "description": "Exemple description", "category": "job", "salary": "1000", "contract": "CDD"}'

    curl http://127.0.0.1:8000/api/announcement/remove/1 -H "Accept: application/json" -X DELETE -u john.doe@symfony.com:admin

    curl http://127.0.0.1:8000/api/announcement -H "Accept: application/json" -X GET -u john.doe@symfony.com:admin

    curl http://127.0.0.1:8000/api/announcement/edit/1 -H "Accept: application/json" -X PUT -u john.doe@symfony.com:admin --data '{"title": "Exemple title"}'
```
