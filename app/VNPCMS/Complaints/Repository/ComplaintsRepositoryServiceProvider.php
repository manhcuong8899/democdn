<?php

namespace VNPCMS\Complaints\Repository;

use View;
use Cache;
use VNPCMS\Complaints\Complaints;
use Illuminate\Support\ServiceProvider;

class ComplaintsRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Complaints::updating(function ($Complaints) { $this->clearCache($Complaints->id); });
        Complaints::creating(function ($Complaints) { $this->clearCache($Complaints->id);});
        Complaints::deleting(function ($Complaints) { $this->clearCache($Complaints->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(ComplaintsRepositoryInterface::class, function () {
            return new CacheableEloquentComplaintsRepository(
                new EloquentComplaintsRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('Complaints')->flush();
    }
}
