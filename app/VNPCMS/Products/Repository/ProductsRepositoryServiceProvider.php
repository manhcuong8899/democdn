<?php

namespace VNPCMS\Products\Repository;

use View;
use Cache;
use VNPCMS\Products\Products;
use Illuminate\Support\ServiceProvider;

class ProductsRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Products::updating(function ($roducts) { $this->clearCache($roducts->id); });
        Products::creating(function ($roducts) { $this->clearCache($roducts->id);});
        Products::deleting(function ($roducts) { $this->clearCache($roducts->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(ProductsRepositoryInterface::class, function () {
            return new CacheableEloquentProductsRepository(
                new EloquentProductsRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('products')->flush();
    }
}
