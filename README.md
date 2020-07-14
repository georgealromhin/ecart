<p align="center"><img src="https://raw.githubusercontent.com/GeorgeT01/ecart/master/redmecontent/ecart-banner.svg" width="400"></p>


## About ECART

ECART is A free shopping cart system.

[Requirements](#Requirements)

[Local Setup](#Local-Setup)

[User Guide](#User-Guide)


## Requirements

- PHP >= 7.2.5
- Laravel 7.x
- PostgreSQL or MySQL


## Local-Setup
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

#### 7- Create an empty database for your project

#### 8- In the .env file, add database information to allow Laravel to connect to the database and also change app name

```
APP_NAME=E-Cart
```
PostgreSQL
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=password
```

MySQL
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=password
```
#### 8- In the .env file, edit email configuration
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=example@domain.com
MAIL_FROM_NAME="${APP_NAME}"
```
#### 9- Migrate and seed the database
```
php artisan migrate
```
```
php artisan db:seed
```
#### 10- Go to app > Providers > AppServiceProvider.php, and uncomment code 
```
 public function boot()
    {
        // uncomment
        
        $settings = Settings::orderBy('id', 'asc')->get();
        View::share([
             'settings' => $settings,
        ]);
    }
```
#### 11- if you are using MySQL Database, go to app > Http > Controllers > Admin > DashboardController.php
comment code:
```
     /* ---------------PostgreSQL---------------*/
        // $orders = $order->select(DB::raw("to_char(created_at ,'Month YYYY') as date"), DB::raw('count(*) as total'))
        // ->groupBy('date')
        // ->orderBy(DB::raw("max(created_at)"), 'ASC')
        // ->get();

        // $sales = $order->select(DB::raw("to_char(created_at ,'Month YYYY') as date"), DB::raw('SUM(total) as total'))
        // ->where('order_status', 'Delivered')
        // ->groupBy('date')
        // ->orderBy(DB::raw("max(created_at)"), 'ASC')
        // ->get();
```
and uncomment: 
```
    /* ---------------MySQL--------------- */
    $orders = $order->select(DB::raw('DATE_FORMAT(created_at, "%M-%Y") as date'), DB::raw('count(*) as total'))
    ->groupBy('date')->orderBy(DB::raw("max(created_at)"), 'ASC')
    ->get();

    $sales = $order->select(DB::raw('DATE_FORMAT(created_at, "%M-%Y") as date'), DB::raw('SUM(total) as total'))
    ->where('order_status', 'Delivered')
    ->groupBy('date')
    ->orderBy(DB::raw("max(created_at)"), 'ASC')
    ->get();
```
#### 12- Go to config > app.php, and change email_address and currency to your preferences
```
    'currency' => '$',
    'email_address' => 'example@domain.com', 
```
#### 13- Enjoy


## User-Guide


