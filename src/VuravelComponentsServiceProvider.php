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
        
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'vuravel');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
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
