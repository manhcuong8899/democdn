<?php

namespace VNPCMS\Banks\Repository;

use View;
use Cache;
use VNPCMS\Banks\Banks;
use Illuminate\Support\ServiceProvider;

class BanksRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
       Banks::updating(function ($articles) { $this->clearCache($articles->id); });
        Banks::creating(function ($articles) { $this->clearCache($articles->id);});
        Banks::deleting(function ($articles) { $this->clearCache($articles->id);});
        View::composer('themes.includes.slidebar', 'VNPCMS\Banks\Composers\Systembanks');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(BanksRepositoryInterface::class, function () {
            return new CacheableEloquentBanksRepository(
                new EloquentBanksRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('image')->flush();
    }
}
