<?php

namespace VNPCMS\Notification\Repository;

use View;
use Cache;
use VNPCMS\Notification\Notification;
use Illuminate\Support\ServiceProvider;

class NotificationRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Notification::updating(function ($Notification) { $this->clearCache($Notification->id); });
        Notification::creating(function ($Notification) { $this->clearCache($Notification->id);});
        Notification::deleting(function ($Notification) { $this->clearCache($Notification->id);});
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
       /*  $this->app->bind(ArticlesRepositoryInterface::class, EloquentArticlesRepository::class);*/
       $this->app->singleton(NotificationRepositoryInterface::class, function () {
            return new CacheableEloquentNotificationRepository(
                new EloquentNotificationRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache()
    {
        Cache::tags('cate_article')->flush();
    }
}
