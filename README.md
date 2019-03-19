# SimpleUserWebApp
This Web App able to register user with name, birthdate and multiple email. The webapp made with laravel, bootstrap, vuejs with routing.
## Features
### List users
List all user with pagination
url : [project domain]/#/users
### Create user
Create new user
url: [project domain]/#/CreateUser
# Installation
## Server Requirements
-   PHP >= 7.1.3
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Mbstring PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension
-   Ctype PHP Extension
-   JSON PHP Extension
-   BCMath PHP Extension
## Installation guide
 1. Get github repository:  `git clone https://github.com/vassdavid/SimpleUserWebApp.git`
 2. Copy .env.example to .env in project folder.
 3. Edit database settings: (DB_DATABASE, DB_USERNAME, DB_PASSWORD) in .env file (create database if not exist).
 4. Run `composer install` in project folder.
 5. Make app key with `php artisan key:generate`.
 6. Migrate database tables `php artisan migrate`
 7. Run app `php artisan serve`

More info: [laravel installation](https://laravel.com/docs/5.8/installation)
## Devevolopment
The `php artisan serve` command isn't enough to run the test functions.
Must run in a web server!
### Testing
The test files are contained in the test folder. There are two types of tests: feature and unit test.
The feature test contain the test of controller (read and write user).
The unit test contain the test of User model.
The project also have factories and database seeder.
#### Run tests
##### Database seeder
 If you fill generated users the database rund the`php artisan db:seed`command.
 ##### Unit and feature test
Run  `phpunit` command if you install phpunit in globally, else run  `vendor/bin/phpunit` in project folder. 
