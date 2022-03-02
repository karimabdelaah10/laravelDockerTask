# Laravel Docker Project


## To Run the project
inside project directory

- create docker network named "laravel" `docker network create laravel`
- `docker-compose build` you may need to use `sudo`
- `docker-compose up -d` you may need to use `sudo`
- go to src directory `cd src/`
- Copy the .env.example to .env `cp .env.example .env`
- if you need run `composer install` maybe not
- do your work 

### browse [http://localhost:8088](http://localhost:8088) for the app

### when changing any configuration in the Dockerfile or docker-compose you have to run `sudo docker-compose build`

[//]: # (## To Run The Unit Tests)

[//]: # (- run `./vendor/bin/phpunit ./tests/Feature/ExampleTest.php`)

### To Add New Provider 
####1- add provider json file to /public ( make sure that file has the same structure of providers files )

####2- add the new file structure to FILES_STRUCTURE array in src/app/Http/Enums/MainEnums.php:13 (with the same structure)
### Use this curl to test the api

curl --location --request GET 'http://localhost:8088/api/v1/users?currency=ASD&balanceMin=200&balanceMax=250&statusCode=authorised&provider=dataProviderX' \
--header 'Accept: application/json'