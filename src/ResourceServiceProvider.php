<?php

namespace TehekOne\Laravel\Resources;

use Illuminate\Support\ServiceProvider;

/**
 * Class ResourceServiceProvider
 *
 * @package TehekOne\Laravel\Resources
 */
class ResourceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filters');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'filters-migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/filters'),
            ], 'filters-views');
        }
    }
}
