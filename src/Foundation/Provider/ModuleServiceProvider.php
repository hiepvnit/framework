<?php

namespace Mage2\Framework\Foundation\Provider;

use Illuminate\Support\ServiceProvider;
use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\App;
use Mage2\Framework\View\AdminMenu;
use Mage2\Framework\Shipping\ShippingManager;
use Mage2\Framework\Payment\PaymentManager;
use Mage2\Framework\View\AdminConfiguration;
use Mage2\Framework\Theme\ThemeManager;
use Mage2\Framework\Routing\UrlGenerator;

class ModuleServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->registerAdminMenuFacade();
        $this->registerAdminConfigurationFacade();
        $this->registerModule();
        $this->registerTheme();
        $this->app['request']->server->set('HTTPS','off');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->_registerShippingFacade();
        $this->registerUrlGenerator();

        $this->_registerPaymentFacade();
        $this->_registerThemeFacade();
    }

    public function registerModule() {

        $mage2Module = config('module');
        foreach ($mage2Module as $namespace => $path ) {

            $loader = new ClassLoader();
            $loader->addPsr4($namespace, $path);
            $loader->register();
            //Register ServiceProvider for Modules
            $extensionProvider = str_replace("\\", "", $namespace . "ServiceProvider");
            App::register($namespace . $extensionProvider);

        }


    }

    public function registerTheme() {

        $mage2Module = config('theme');
        foreach ($mage2Module as $namespace => $path ) {

            $loader = new ClassLoader();
            $loader->addPsr4($namespace, $path);
            $loader->register();
            //Register ServiceProvider for Modules
            //$extensionProvider = str_replace("\\", "", $namespace. "\\" . "ThemeInfo");
            //dd($namespace . "ThemeInfo");die;
            App::register($namespace . "ThemeInfo");

        }


    }

    /**
     * Register the URL generator service.
     *
     * @return void
     */
    protected function registerUrlGenerator()
    {
        $this->app['url'] = $this->app->share(function ($app) {
            $routes = $app['router']->getRoutes();

            // The URL generator needs the route collection that exists on the router.
            // Keep in mind this is an object, so we're passing by references here
            // and all the registered routes will be available to the generator.
            $app->instance('routes', $routes);

            $url = new UrlGenerator(
                $routes, $app->rebinding(
                'request', $this->requestRebinder()
            )
            );

            $url->setSessionResolver(function () {
                return $this->app['session'];
            });

            // If the route collection is "rebound", for example, when the routes stay
            // cached for the application, we will need to rebind the routes on the
            // URL generator instance so it has the latest version of the routes.
            $app->rebinding('routes', function ($app, $routes) {
                $app['url']->setRoutes($routes);
            });

            return $url;
        });
    }

    private function _registerShippingFacade() {
        App::bind('Shipping', function() {
            return new ShippingManager;
        });
    }

    /**
     * Get the URL generator request rebinder.
     *
     * @return \Closure
     */
    protected function requestRebinder()
    {
        return function ($app, $request) {
            $app['url']->setRequest($request);
        };
    }

    private function _registerPaymentFacade() {
        App::bind('Payment', function() {
            return new PaymentManager;
        });
    }

    private function _registerThemeFacade() {
        App::bind('Theme', function() {
            return new ThemeManager;
        });
    }

    private function _registerExtensionFacade() {
        App::bind('Extension', function() {
            return new ExtensionManager;
        });
    }

    public function registerAdminMenuFacade() {
        App::bind('AdminMenu', function() {
            return new AdminMenu;
        });
    }

    public function registerAdminConfigurationFacade() {
        App::bind('AdminConfiguration', function() {
            return new AdminConfiguration();
        });
    }

}
