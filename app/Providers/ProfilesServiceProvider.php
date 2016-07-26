<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('user','App\Http\ViewComposer\ProfileComposer');

        view()->composer('relations','App\Http\ViewComposer\ProfileComposer');

        view()->composer('utility.prefilControl','App\Http\ViewComposer\ProfileComposer');

        //Using Closure based Composer...
        //view()->composer('utility.prefilControl', function($view){
        //
        //});
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
