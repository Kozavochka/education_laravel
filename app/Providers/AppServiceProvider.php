<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\Contracts\AuthServiceContract;
use App\Services\Auth\Contracts\RegisterServiceContract;
use App\Services\Auth\RegisterService;
use App\Services\Order\Contracts\OrderServiceContract;
use App\Services\Order\OrderService;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //внедрение зависимости
        $this->app->singleton(AuthServiceContract::class,AuthService::class);
        $this->app->singleton(RegisterServiceContract::class,RegisterService::class);
        $this->app->singleton(OrderServiceContract::class,OrderService::class);
    }
}
