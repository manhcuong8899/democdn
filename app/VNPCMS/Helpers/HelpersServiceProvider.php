<?php

namespace VNPCMS\Helpers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        foreach (glob(app_path().'/VNPCMS/Helpers/Functions/*.php') as $filename) {
            require_once $filename;
        }
    }
}

