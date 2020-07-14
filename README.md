<p align="center"><img src="https://raw.githubusercontent.com/GeorgeT01/ecart/master/redmecontent/ecart-banner.svg" width="400"></p>


## About ECART

ECART is A free shopping cart system.

[Requirements](#Requirements)

[How to Install](#HowtoInstall)

[User Manual](#userManul)


## Requirements

- PHP >= 7.2.5
- Laravel 7.x
- PostgreSQL or MySQL


## HowtoInstall
#### 1- Clone GitHub repo for this project locally
```
git clone https://github.com/GeorgeT01/ecart.git projectName
```
#### 2- Change directory into your project
```
cd projectName
```
#### 3- Install Composer Dependencies
```
composer install
```
#### 4- Install NPM Dependencies
```
npm install
```
#### 5- Create a copy of your .env file
```
cp .env.example .env
```
#### 6- Generate an app encryption key
```
php artisan key:generate
```
