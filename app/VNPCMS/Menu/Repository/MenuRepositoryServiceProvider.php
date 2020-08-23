<?php

namespace VNPCMS\Menu\Repository;

use View;
use Cache;
use VNPCMS\Menu\Menu;
use Illuminate\Support\ServiceProvider;

class MenuRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register composer views.
     */
    public function boot()
    {
        // TEMPORARY SOLUTION
        Menu::updating(function ($menu) { $this->clearCache($menu->id);});
        Menu::creating(function ($menu) { $this->clearCache($menu->id);});
        Menu::deleting(function ($menu) { $this->clearCache($menu->id);});
        View::composer('includes.publicnavigation', 'VNPCMS\Menu\Composers\PublicNavigation');
        View::composer('includes.mainnavigation', 'VNPCMS\Menu\Composers\MainNavigation');
        View::composer('includes/settingsnavigation', 'VNPCMS\Menu\Composers\SettingsNavigation');
        View::composer('themes.includes.*','VNPCMS\Menu\Composers\PublicNavigation');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        // $this->app->bind(MenuRepositoryInterface::class, EloquentMenuRepository::class);
        $this->app->singleton(MenuRepositoryInterface::class, function () {
            return new CacheableEloquentMenuRepository(
                new EloquentMenuRepository(),
                $this->app['cache.store']
            );
        });
    }

    private function clearCache($menuId)
    {   
        Cache::tags('menus')->flush();
        // Cache::forget('menus.all');
        // Cache::forget('menus.byId.'.$menuId);
        // foreach (crminfo('menu_groups') as $menugroup) {
        //     Cache::forget('menus.byGroup.'.$menugroup);
        // }
    }
}
