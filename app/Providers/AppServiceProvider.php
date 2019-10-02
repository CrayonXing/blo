<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Helpers\ServiceHelp;
class AppServiceProvider extends ServiceProvider
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
        $this->app->singleton('service.help',function(){
            return new ServiceHelp;
        });
    }
}
