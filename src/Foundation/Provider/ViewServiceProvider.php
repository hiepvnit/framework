<?php

namespace Mage2\Framework\Foundation\Provider;

use Illuminate\Support\ServiceProvider;
use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\App;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        View::composer('layouts.admin-nav', function ($view) {

            $adminMenus = (array)  AdminMenu::getMenuItems();
            $view->with('adminMenus', $adminMenus);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
