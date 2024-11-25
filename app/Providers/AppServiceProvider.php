<?php

namespace App\Providers;

use App\Repository\CrudRepository;
use App\Repository\Interface\CrudInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CrudInterface::class, function ($app) {
            return new CrudRepository($app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
