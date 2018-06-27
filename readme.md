<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
<p align="center">
<a href="https://travis-ci.org/dmitry-udod/dnipro-map.svg?branch=master"><img src="https://travis-ci.org/dmitry-udod/dnipro-map.svg?branch=master" alt="Build Status"></a>
</p>

## Requirements

- PHP >= 7.1
- PostgreSQL >= 9.5

## Install

- composer install
- php artisan migrate
- npm install
- npm run production
- Setup your web server (https://laravel.com/docs/5.6/deployment#server-configuration)

#### Run seeds (not required) 

- php artisan db:seed --class=CityTableSeeder
- php artisan db:seed --class=MarganetsClinics
- php artisan db:seed --class=MarganetsCivilBudget
- php artisan db:seed --class=MarganetsAfterSchool
- php artisan db:seed --class=MarganetsTempConstructions
- php artisan db:seed --class=MarganetsKindergardens
- php artisan db:seed --class=MarganetsTempConstructions


