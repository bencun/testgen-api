# TestGen (backend)
A Laravel backend of an application used to generate quizzes.

## Important note

This is only the backend of the application. You can find the frontend here:
https://github.com/bencun/testgen-frontend

## Getting Started

First of all clone the repository to your local dev machine.

### Prerequisites

You will need `PHP 7.1.1` and `MySQL 5.7.17` or newer installed on your machine. You will also need the latest version of `composer` installed.

### Installing the dependencies

After cloning the repository you'll need to install all of the project dependencies. Run the following commands:

```
composer install
```

### Database and application set-up

#### MySQL DB

If you don't have an existing MySQL database that you're going to use you'll need to create a new one and it's recommended to do so.
Also it's recommended to create a user that has all the privileges assigned to it on the database you'll be using.

#### Application settings

You'll need to create an `.env` file in the project root directory. You can grab the template file here:
https://github.com/laravel/laravel/blob/master/.env.example

Essential settings:
```
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### Final steps
After you've setup the `.env` file it's time to wrap it all up so run the following commands in the order they are presented in:

```
php artisan key:generate
php artisan jwt:secret
php artisan vendor:publish
composer dump-autoload
php artisan migrate
```

Optionally, you could also afterwards the seed the DB instead of simply migrating it (there is some demo data in the seeds and user accounts you can use):
```
php artisan migrate:refresh --seed
```

### Running the backend

To start the development server run:

```
php artisan serve
```

The server runs on `localhost:8000` by default.

## Unit tests

There are currently no tests whatsoever.