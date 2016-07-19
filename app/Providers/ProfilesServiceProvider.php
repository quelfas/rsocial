<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class ProfilesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Using class based  Composer...
        View::composer('user','App\Http\ViewComposer\ProfileComposer');

        //Using Closure based Composer...
        View::composer('utility.prefilControl', function($view){
            //
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
