<?php

namespace VNPCMS\Catearticle\Repository;

use View;
use Cache;
use VNPCMS\Catearticle\CateArticles;
use Illuminate\Support\ServiceProvider;

class CateArticlesRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        CateArticles::updating(function ($catearticles) { $this->clearCache($catearticles->id); });
        CateArticles::creating(function ($catearticles) { $this->clearCache($catearticles->id);});
        CateArticles::deleting(function ($catearticles) { $this->clearCache($catearticles->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(CateArticlesRepositoryInterface::class, function () {
            return new CacheableEloquentCateArticlesRepository(
                new EloquentCateArticlesRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('cate_article')->flush();
    }
}
