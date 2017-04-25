# Setup

Clone this repository, and install the [node package manager](http://npmjs.com/) as well as [composer](https://getcomposer.org/). 
We also require a PHP version that can run [Laravel](https://laravel.com/) along with MySQL and the corresponding PHP 
In the root directory, run
```
composer install
npm install
npm run dev
```

To setup the databse, run
```
mysql -u root -p
>>> create databse laravel;
>>> show databases;
>>> exit
php artisan migrate
```

To start the application run
```
php artisan serve
```
or setup an NGINX/XAMPP server using the `./public` directory.

