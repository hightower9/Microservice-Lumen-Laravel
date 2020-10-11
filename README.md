# Microservice-Lumen-Laravel
Laravel/Lumen microservice  for authors and books API

To run this Microservice, you need to do the following things
- Run "composer install" in each microservice 
- Then create tables for each microservice
- Next run "php artisan migrate"
- Run "php artisan db:seed" to populate table with fake data
- Now in the Gateway microservice run "php artisan passport:install"
- Finally run your API in the command line
- For Gateway : php -S localhost:8000 public/index.php
- For Author : php -S localhost:8001 public/index.php
- For Book : php -S localhost:8002 public/index.php
- Now test your API's !!!!
