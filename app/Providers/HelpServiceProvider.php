<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Helpers\Help;

class HelpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('help',function(){
            return new Help;
        });
    }
}