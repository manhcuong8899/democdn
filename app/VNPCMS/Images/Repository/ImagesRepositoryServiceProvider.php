<?php

namespace VNPCMS\Images\Repository;

use View;
use Cache;
use VNPCMS\Images\Images;
use Illuminate\Support\ServiceProvider;

class ImagesRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
       Images::updating(function ($articles) { $this->clearCache($articles->id); });
        Images::creating(function ($articles) { $this->clearCache($articles->id);});
        Images::deleting(function ($articles) { $this->clearCache($articles->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(ImagesRepositoryInterface::class, function () {
            return new CacheableEloquentImagesRepository(
                new EloquentImagesRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('image')->flush();
    }
}
