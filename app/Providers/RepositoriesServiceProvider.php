<?php

namespace App\Providers;

use App\Contracts\MenuRepositoryContract;
use App\Repositories\MenuRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            MenuRepositoryContract::class,
            MenuRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
