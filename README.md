# Microservice-Lumen-Laravel
***Laravel/Lumen microservice for authors and books API with Gateway of Laravel Passport (OAuth)***

To run this Microservice, you need to do the following things
- Run `composer install` in each microservice 
- Then create tables for each microservice
- Next run `php artisan migrate`
- Run "php artisan db:seed" to populate table with fake data
- Now in the Gateway microservice run `php artisan passport:install`
- Finally run your API in the command line
- For Gateway : `php -S localhost:8002 -t public`
- For Author : `php -S localhost:8000 public/index.php`, this command is different due to Swagger Documentation
- For Book : `php -S localhost:8001 -t public`
- Now test your API's !!!!

#### To view Swagger Documentation
- Run localhost:8000/api/documentation, if it doesn't work comment the global middleware in bootstrap/app.php and try again.
