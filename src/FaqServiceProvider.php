<?php
namespace Selfreliance\Faq;

use Illuminate\Support\ServiceProvider;
use App;
class FaqServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes.php';
        $this->app->make('Selfreliance\Faq\FaqController');
        $this->loadViewsFrom(__DIR__.'/views', 'faq');
                
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        App::bind('faq', function(){
            return new \Selfreliance\Faq\Faq;
        });
    }
}