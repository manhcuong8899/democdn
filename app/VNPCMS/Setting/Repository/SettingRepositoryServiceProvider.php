<?php

namespace VNPCMS\Setting\Repository;

use View;
use Cache;
use VNPCMS\Setting\Setting;
use Illuminate\Support\ServiceProvider;

class SettingRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Setting::updating(function ($setting) { $this->clearCache($setting->key); });
        Setting::creating(function ($setting) { $this->clearCache($setting->key);});
        Setting::deleting(function ($setting) { $this->clearCache($setting->key);});
        View::composer('themes.*', 'VNPCMS\Setting\Composers\Settings');
        View::composer('themes.*', 'VNPCMS\Setting\Composers\ViewImages');
        View::composer('themes.includes.*', 'VNPCMS\Setting\Composers\Currencys');
        View::composer('themes.home.*', 'VNPCMS\Setting\Composers\Supports');
        View::composer('themes.includes.*','VNPCMS\Setting\Composers\Notificationuser');
        View::composer('themes.home.*','VNPCMS\Setting\Composers\Tips');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        // $this->app->bind(SettingRepositoryInterface::class, EloquentSettingRepository::class);
        $this->app->singleton(SettingRepositoryInterface::class, function () {
            return new CacheableEloquentSettingRepository(
                new EloquentSettingRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache($key)
    {
        Cache::tags('settings')->flush();
        // Cache::forget('setting.all');
        // Cache::forget('setting.byKey.'.$key);
    }
}
