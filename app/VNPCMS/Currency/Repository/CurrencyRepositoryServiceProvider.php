<?php

namespace VNPCMS\Currency\Repository;

use View;
use Cache;
use VNPCMS\Currency\Currency;
use Illuminate\Support\ServiceProvider;

class CurrencyRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Currency::updating(function ($Currency) { $this->clearCache($Currency->id); });
        Currency::creating(function ($Currency) { $this->clearCache($Currency->id);});
        Currency::deleting(function ($Currency) { $this->clearCache($Currency->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(CurrencyRepositoryInterface::class, function () {
            return new CacheableEloquentCurrencyRepository(
                new EloquentCurrencyRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('cate_article')->flush();
    }
}
