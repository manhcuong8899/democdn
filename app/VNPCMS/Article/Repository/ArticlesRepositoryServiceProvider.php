<?php

namespace VNPCMS\Article\Repository;

use View;
use Cache;
use VNPCMS\Article\Articles;
use Illuminate\Support\ServiceProvider;

class ArticlesRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Articles::updating(function ($articles) { $this->clearCache($articles->id); });
        Articles::creating(function ($articles) { $this->clearCache($articles->id);});
        Articles::deleting(function ($articles) { $this->clearCache($articles->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(ArticlesRepositoryInterface::class, function () {
            return new CacheableEloquentArticlesRepository(
                new EloquentArticlesRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('article')->flush();
    }
}
