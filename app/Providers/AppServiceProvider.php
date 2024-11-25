<?php

namespace App\Providers;

use App\Models\Magang;
use App\Policies\MagangPolicy;
use App\Repository\CrudRepository;
use App\Repository\Interface\CrudInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::policy(Magang::class,MagangPolicy::class);
    }
}
