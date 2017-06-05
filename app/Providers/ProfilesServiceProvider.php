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
        $callbackPerfileComposer = 'App\Http\ViewComposer\ProfileComposer';
        view()->composer('user',$callbackPerfileComposer);
        view()->composer('editBio',$callbackPerfileComposer);
        view()->composer('relations',$callbackPerfileComposer);
        view()->composer('profile',$callbackPerfileComposer);
        view()->composer('myprofile',$callbackPerfileComposer);
        
        view()->composer('help.assistance',$callbackPerfileComposer);
        view()->composer('help.help',$callbackPerfileComposer);
        view()->composer('help.helplist',$callbackPerfileComposer);

        view()->composer('pswUpdate',$callbackPerfileComposer);
        
        view()->composer('us.godparents',$callbackPerfileComposer);
        view()->composer('us.joinUs',$callbackPerfileComposer);
        view()->composer('us.sponsored',$callbackPerfileComposer);
        view()->composer('us.staff',$callbackPerfileComposer);
        view()->composer('us.supportUs',$callbackPerfileComposer);
        
        view()->composer('contact', $callbackPerfileComposer);
        view()->composer('donations', $callbackPerfileComposer);
        view()->composer('event', $callbackPerfileComposer);
        view()->composer('gallery', $callbackPerfileComposer);

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
