<?php

namespace VNPCMS\Userlevel\Repository;

use View;
use Cache;
use VNPCMS\Userlevel\Userlevel;
use Illuminate\Support\ServiceProvider;

class UserlevelRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Userlevel::updating(function ($Userlevel) { $this->clearCache($Userlevel->id); });
        Userlevel::creating(function ($Userlevel) { $this->clearCache($Userlevel->id);});
        Userlevel::deleting(function ($Userlevel) { $this->clearCache($Userlevel->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(UserlevelRepositoryInterface::class, function () {
            return new CacheableEloquentUserlevelRepository(
                new EloquentUserlevelRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('cate_article')->flush();
    }
}
