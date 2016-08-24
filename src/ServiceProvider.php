<?php

namespace GlebStarProducts;

use Illuminate\Support\ServiceProvider as LServiceProvider;

class ServiceProvider extends LServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        include __DIR__ . '/routes.php';

        // published migrations
        $this->publishes([__DIR__ . '/../database/' => base_path("database")], 'database');

        // published views
        $this->loadViewsFrom(__DIR__ . '/../views', 'products');
        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/products'),
        ], 'views');
    }
}
