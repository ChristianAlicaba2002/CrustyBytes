<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Product\ProductRepository;
use App\Infrastructure\Eloquent\Product\EloquentProductRepository;
use App\Domain\Order\OrderRepository;
use App\Infrastructure\Eloquent\Order\EloquentOrderRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ProductRepository::class, EloquentProductRepository::class);
        $this->app->singleton(OrderRepository::class, EloquentOrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
