<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\Home\HomeRepositoryInterface',
            'App\Repositories\Home\HomeRepository'
        );
        $this->app->bind(
            'App\Repositories\TypeItem\TypeItemRepositoryInterface',
            'App\Repositories\TypeItem\TypeItemRepository'
        );
        $this->app->bind(
            'App\Repositories\BrandProduct\BrandProductRepositoryInterface',
            'App\Repositories\BrandProduct\BrandProductRepository'
        );
        $this->app->bind(
            'App\Repositories\CategoryProduct\CategoryProductRepositoryInterface',
            'App\Repositories\CategoryProduct\CategoryProductRepository'
        );
        $this->app->bind(
            'App\Repositories\Product\ProductRepositoryInterface',
            'App\Repositories\Product\ProductRepository'
        );
        $this->app->bind(
            'App\Repositories\Customer\CustomerRepositoryInterface',
            'App\Repositories\Customer\CustomerRepository'
        );
        $this->app->bind(
            'App\Repositories\Payment\PaymentRepositoryInterface',
            'App\Repositories\Payment\PaymentRepository'
        );
        $this->app->bind(
            'App\Repositories\Checkout\CheckoutRepositoryInterface',
            'App\Repositories\Checkout\CheckoutRepository'
        );
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
