# Products Manager package for Laravel 5.2

This is a Laravel 5 package - https://github.com/glebstar/laravel5-products

[![GitHub Author](https://img.shields.io/badge/author-@glebstar-lightgrey.svg?style=flat-square)](https://github.com/glebstar)

## Installation

```json
{
    "require": {
        "glebstar/laravel5-products": "1.0.*"
    }
}
```

or run `composer require glebstar/laravel5-products`

Then run composer update in your terminal to pull it in.

You will need to add the service provider to the providers array in your app.php config as follows:
```php
GlebStarProducts\ServiceProvider::class,
```

Add a alias for ProductMiddleware in app/Http/Kernel.php into $routeMiddleware array:
```php
'product' => \GlebStarProducts\Middleware\ProductMiddleware::class,
```

To publish a the package files, run:

```shell
php artisan vendor:publish --provider="GlebStarProducts\ServiceProvider"
```

Apply migration

```shell
php artisan migrate
```