<p align="center"><img src="https://raw.githubusercontent.com/dmitry-udod/dnipro-map/master/docs_images/logo.png"></p>
<p align="center">
<a href="https://travis-ci.org/dmitry-udod/dnipro-map"><img src="https://travis-ci.org/dmitry-udod/dnipro-map.svg?branch=master" alt="Build Status"></a>
</p>

[![Build status](https://badge.buildkite.com/6d8a48342b34655dba42e1ef1b4141cbf4c3268d97334a0c13.svg)](https://buildkite.com/dniprorada/dnipromap)

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


