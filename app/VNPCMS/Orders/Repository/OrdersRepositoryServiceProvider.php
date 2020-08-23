<?php

namespace VNPCMS\Orders\Repository;

use View;
use Cache;
use VNPCMS\Orders\Orders;
use Illuminate\Support\ServiceProvider;

class OrdersRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Orders::updating(function ($Orders) { $this->clearCache($Orders->id); });
        Orders::creating(function ($Orders) { $this->clearCache($Orders->id);});
        Orders::deleting(function ($Orders) { $this->clearCache($Orders->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(OrdersRepositoryInterface::class, function () {
            return new CacheableEloquentOrdersRepository(
                new EloquentOrdersRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('Orders')->flush();
    }
}
