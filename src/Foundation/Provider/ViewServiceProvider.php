<?php

namespace Mage2\Framework\Foundation\Provider;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\View\ViewServiceProvider as LaravelViewServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Mage2\Framework\View\FileViewFinder;

class ViewServiceProvider extends LaravelViewServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //parent::boot();
        View::composer('layouts.admin-nav', function ($view) {
            $adminMenus = (array) AdminMenu::getMenuItems();
            $view->with('adminMenus', $adminMenus);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerViewFinder();
        //
    }

    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            $paths = $app['config']['view.paths'];

            return new FileViewFinder($app['files'], $paths);
        });
    }
}
