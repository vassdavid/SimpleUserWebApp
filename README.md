# SimpleUserWebApp
This Web App able to register user with name, birthdate and multiple email.


# Instllation
#### Server Requirements
-   PHP >= 7.1.3
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Mbstring PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension
-   Ctype PHP Extension
-   JSON PHP Extension
-   BCMath PHP Extension

 1. Get github repository:  `git clone https://github.com/vassdavid/SimpleUserWebApp.git`
 2. Copy .env.example to .env.
 3. Edit database settings: (DB_DATABASE, DB_USERNAME, DB_PASSWORD) in .env file (create database if not exist).
 4. Run `composer install` in project folder.
 5. Make app key with `php artisan key:generate`.
 6. Migrate database tables `php artisan migrate`
 7. Run app `php artisan serve`

 More info: [laravel installation](https://laravel.com/docs/5.8/installation)
