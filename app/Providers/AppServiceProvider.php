<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Product\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Repositories\ProductRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
