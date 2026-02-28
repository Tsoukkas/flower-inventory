<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CategoryService;
use App\Services\FlowerService;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\FlowerServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    public function register(): void
{
    $this->app->bind(FlowerServiceInterface::class, FlowerService::class);
    $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
}
}
