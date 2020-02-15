<?php

namespace Vuravel\Components;

use Illuminate\Support\ServiceProvider;

class VuravelComponentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/vuravel.php', 'vuravel');

        if (file_exists($file = __DIR__.'/VuravelComponentsHelpers.php'))
            require_once $file;
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
