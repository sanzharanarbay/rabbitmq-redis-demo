<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Install With Docker
Laravel RabbitMQ and Redis Demo Application With Docker
- copy .env.example .env .
- docker-compose build .
- docker-compose up -d .
- docker-compose exec php bash .
- composer install .
- php artisan optimize .
- php artisan migrate .
- exit from container with command exit
- docker exec testapp-rabbitmq rabbitmq-plugins enable rabbitmq_management .
- http://localhost:8000/ - Laravel Application
- http://localhost:15672/ - RabbitMQ Management
- http://localhost:8081/ - Redis Commander
- http://localhost:5050/ - PgAdmin 4
- http://localhost:8087/ - PhpPgAdmin


## Install Without Docker

Laravel RabbitMQ and Redis Demo Application Without Docker
- copy .env.example to .env.
- composer install.
- php artisan key:generate.
- php artisan migrate.
- php artisan serve --port 8080.
- POST: http://localhost:8080/api/articles/queue TO push Jobs into Queue.
- php artisan rabbitmq:consume TO Consume Jobs.
- php artisan queue:work 2nd Way To Consume Jobs.
- GET:. http://localhost:8080/api/articles/redis TO work With Redis
- php artisan optimize.



