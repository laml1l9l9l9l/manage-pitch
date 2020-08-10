# manage-pitch.github.io

## Install project when git clone

- Open the console and cd your project root directory
- Run ```cp .env.example .env```
- Run `composer install` or ```php composer.phar install```
- Run `composer update`
- Run `composer dump-autoload`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeders, if any.
- Run `php artisan serve`

## If error permission denied
- Run `cd storage/` and `sudo chmod -R 777 logs`
- Run `cd ..` and `chmod -R 777 storage/`