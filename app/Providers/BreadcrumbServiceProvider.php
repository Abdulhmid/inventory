<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BreadcrumbServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('breadcrumb', function() {
            return new \App\Library\Breadcrumb\Breadcrumb();
        });
    }
}
