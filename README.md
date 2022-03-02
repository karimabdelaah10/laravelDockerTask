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