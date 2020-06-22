<?php

namespace App\Providers;

use App\Http\Services\ItemService;
use App\Http\Services\NotificationService;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production')
        {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->singleton(NotificationService::class, function ()
        {
            return new NotificationService();
        });

        $this->app->bind(ItemService::class, function ()
        {
           return new ItemService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
