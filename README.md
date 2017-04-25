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
# create the database 
>>> create databse laravel;
# verify that the databse exists
>>> show databases;
```
Exit the mysql terminal and copy the `.env.example` file to `.env`, changing the databse settings according to your configuration. You should modify the keys `DB_DATABASE` to `laravel` and set the `DB_USERNAME` and `DB_PASSWORD` according to your mysql settings.

Now prepare the Application key:
```
php artisan key:generate
```

To start the application run
```
php artisan serve
```
or setup an NGINX/XAMPP server using the `./public` directory.

