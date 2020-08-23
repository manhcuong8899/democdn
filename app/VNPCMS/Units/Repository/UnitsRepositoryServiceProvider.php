<?php

namespace VNPCMS\Units\Repository;

use View;
use Cache;
use VNPCMS\Units\Units;
use Illuminate\Support\ServiceProvider;

class UnitsRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Units::updating(function ($Units) { $this->clearCache($Units->id); });
        Units::creating(function ($Units) { $this->clearCache($Units->id);});
        Units::deleting(function ($Units) { $this->clearCache($Units->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(UnitsRepositoryInterface::class, function () {
            return new CacheableEloquentUnitsRepository(
                new EloquentUnitsRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('cate_article')->flush();
    }
}
