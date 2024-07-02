<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Parsedown;

class ParsedownServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Parsedown::class, function ($app) {
            return new Parsedown();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
