<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Todo App
## Getting started

Assuming you've already installed on your machine: PHP (>= 7.0.0), [Laravel](https://laravel.com) and [Composer](https://getcomposer.org)

Clone the repository
``` bash
git clone https://github.com/FabioTECH1/ToDo-App.git
```

Switch to the repo folder
``` bash
cd ToDo-App
```

Install all the dependencies using composer
``` bash
composer install
composer require tymon/jwt-auth
```

## Create .env file and make the required configuration changes in it, run the database migrations (**Set the database connection in .env before migrating**)

Generate a new JWT authentication secret key to the .env
``` bash
php artisan jwt:secret
```

Publish the config 
``` bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

Migrate to database
``` bash
php artisan migrate
```

Then launch the server:
``` bash
php artisan serve
```

## The Laravel sample project is now up and running! Access it at http://127.0.0.1:8000.
----------
 
# Authentication
 
This applications uses JSON Web Token (JWT) to handle authentication. The token is passed with each request using the `Authorization` header with `Token` scheme. The JWT authentication middleware handles the validation and authentication of the token. Please check the following sources to learn more about JWT.
 
- https://jwt.io/introduction/
- https://self-issued.info/docs/draft-ietf-oauth-json-web-token.html

----------

