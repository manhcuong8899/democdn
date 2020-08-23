<?php

namespace VNPCMS\Property\Repository;

use View;
use Cache;
use VNPCMS\Property\Properties;
use Illuminate\Support\ServiceProvider;

class PropertiesRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Properties::updating(function ($Properties) { $this->clearCache($Properties->id); });
        Properties::creating(function ($Properties) { $this->clearCache($Properties->id);});
        Properties::deleting(function ($Properties) { $this->clearCache($Properties->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(PropertiesRepositoryInterface::class, function () {
            return new CacheableEloquentPropertiesRepository(
                new EloquentPropertiesRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('cate_article')->flush();
    }
}
