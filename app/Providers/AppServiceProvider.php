<?php

namespace App\Providers;

use App\Models\Magang;
use App\Policies\MagangPolicy;
use App\Repository\CrudRepository;
use App\Repository\Interface\CrudInterface;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
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
        Carbon::setLocale('id');
        Paginator::useBootstrap();
        Gate::policy(Magang::class,MagangPolicy::class);
    }
}
