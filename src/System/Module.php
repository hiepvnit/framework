<?php

namespace Mage2\Framework\System;

use Illuminate\Support\Facades\View;
use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\App;
use Mage2\Framework\Shipping\ShippingManager;
use Mage2\Framework\Theme\ThemeManager;
use Mage2\Framework\System\View\AdminMenu;
use Mage2\Framework\System\View\Facades\AdminMenu as AdminMenuFacade;
use Mage2\Framework\System\Middleware\Website as WebsiteMiddleware;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Category;
use Illuminate\Support\Facades\Auth;
use Mage2\Framework\System\View\FileViewFinder;
use Mage2\Attribute\Models\ProductAttribute;
use Illuminate\View\ViewServiceProvider as BaseModule;

class Module extends BaseModule {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
        $this->registerAdminMenuFacade();
        

        //$this->registerPaymentManager();
        //$this->_registerPaymentFacade();

        $this->_registerThemeFacade();

        $this->app['request']->server->set('HTTPS', 'off');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

        $this->app->bind('view.finder', function ($app) {
            $paths = $app['config']['view.paths'];

            return new FileViewFinder($app['files'], $paths);
        });


        $this->registerMiddleware();
        //$this->mapWebRoutes();
        //$this->registerAdminMenu();
        //$this->registerAdminConfiguration();
        //$this->registerViewPath();
        $this->registerViewComposerData();
        $this->registerTheme();

        //$this->registerUrlGenerator();
    }

    /**
     * Register the middleware for the mage2 auth modules.
     *
     * @return void
     */
    public function registerMiddleware() {

        $router = $this->app['router'];
        $router->middleware('website', WebsiteMiddleware::class);


        //$router = $this->app['router'];
        //$router->middleware('web', EncryptCookies::class);
        //$router->middleware('web', VerifyCsrfToken::class);
    }

    public function registerViewComposerData() {
        view()->composer('*', function ($view) {
            $view->with('isDefaultWebsite', Session::get('is_default_website'));
        });

        view()->composer(['my-account.sidebar'], function ($view) {
            $user = Auth::user();
            $view->with('user', $user);
        });

    }

    public function registerModule() {
        $mage2Module = config('module');
        foreach ($mage2Module as $namespace => $path) {
            $loader = new ClassLoader();
            $loader->addPsr4($namespace, $path);
            $loader->register();
            //Register ServiceProvider for Modules
            $extensionProvider = str_replace('\\', '', $namespace . 'ServiceProvider');
            App::register($namespace . $extensionProvider);
        }
    }

    public function registerTheme() {
        $mage2Module = config('theme');
        foreach ($mage2Module as $namespace => $path) {
            $loader = new ClassLoader();
            $loader->addPsr4($namespace, $path);
            $loader->register();
            //Register ServiceProvider for Modules
            //$extensionProvider = str_replace("\\", "", $namespace. "\\" . "ThemeInfo");
            //dd($namespace . "ThemeInfo");die;
            App::register($namespace . 'ThemeInfo');
        }
    }

    private function _registerShippingFacade() {
        App::bind('Shipping', function () {
            return new ShippingManager();
        });
    }

    /**
     * Get the URL generator request rebinder.
     *
     * @return \Closure
     */
    protected function requestRebinder() {
        return function ($app, $request) {
            $app['url']->setRequest($request);
        };
    }

    private function _registerThemeFacade() {
        App::bind('Theme', function () {
            return new ThemeManager();
        });
    }

    private function _registerExtensionFacade() {
        App::bind('Extension', function () {
            return new ExtensionManager();
        });
    }

    public function registerAdminMenuFacade() {

        App::bind('AdminMenu', function () {
            return new AdminMenu();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['AdminConfiguration', 'AdminMenu', 'Theme', 'Payment', 'Shipping', 'Mage2\Framework\Paymnemt\PaymentManager'];
    }

}
