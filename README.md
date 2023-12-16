## Project Name 
Task Manager

## Prerequisites
   1- Composer <br>
   2- PHP 7.4 <br>
   3- Laravel 8 <br>
   4- Clone the Repository
                    OR
    Download the Repository

## Setup Instructions
After you clone or download the project, navigate to the project directory:

    cd <project-directory>

Install the Composer dependencies:

    composer install

copy .env.example file to file .env:

    cp .env.example .env

Generate a new application key:

    php artisan key:generate

Create Database
    &
Configure the Database:

update .env file<br>

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=root
    DB_PASSWORD=

Run database migration:

    php artisan migrate

Run the project

    php artisan serve
