<p align="center"><img src="https://raw.githubusercontent.com/dmitry-udod/dnipro-map/master/docs_images/logo.png"></p>
<p align="center">
<a href="https://travis-ci.org/dmitry-udod/dnipro-map"><img src="https://travis-ci.org/dmitry-udod/dnipro-map.svg?branch=master" alt="Build Status"></a>
<a href="https://buildkite.com/dniprorada/dnipromap"><img src="https://badge.buildkite.com/6d8a48342b34655dba42e1ef1b4141cbf4c3268d97334a0c13.svg" alt="Buildkite Build Status"></a>
</p>

## Description

This system show city events and facilities on the Google map. 
City admin (multi city support) can easily create markers on the map through admin panel or
import them from CSV file.


## Requirements

- PHP >= 7.1
- PostgreSQL >= 9.5
- Node >= 6.11.2
- NPM >= 3.10.10

## Install

```
$ git clone https://github.com/dmitry-udod/dnipro-map.git
$ composer install
$ php artisan migrate
$ npm install
$ npm run production
```

## Post Install Setup

Copy config file 

```
$ php -r "file_exists('.env') || copy('.env.example', '.env');"

```

Edit `.env` file and check next section

- Change app name (it will be showing in admin panel) 
- Setup your data base connection
- Setup you mail driver (need to sending alert message to users and admins)
- Set next config fields: 
  - DOMAIN_NAME - specify your root domain (__required__)
  - GOOGLE_API_KEY - Google maps api key. The map will not working without this key (__required__)
  - GOOGLE_TAG_MANAGER_HTML - If you have GTM code for your analytics data you can place your GTM code here 
  - CONTACTS_EMAIL - this email address will be show on contacts page.
  
After that you can run 

```
$ php artisan serv

```

And check http://localhost:8000 for testing

#### Run seeds (not required) 
```
$ php artisan db:seed --class=CityTableSeeder
$ php artisan db:seed --class=MarganetsClinics
$ php artisan db:seed --class=MarganetsCivilBudget
$ php artisan db:seed --class=MarganetsAfterSchool
$ php artisan db:seed --class=MarganetsTempConstructions
$ php artisan db:seed --class=MarganetsKindergardens
$ php artisan db:seed --class=MarganetsTempConstructions
```


