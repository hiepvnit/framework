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

class ModuleServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->registerAdminMenuFacade();
        $this->registerAdminConfigurationFacade();
        $this->registerExtension();
        $this->app['request']->server->set('HTTPS','off');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->_registerShippingFacade();
        $this->_registerPaymentFacade();
        $this->_registerThemeFacade();
    }

    public function registerExtension() {

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

    private function _registerShippingFacade() {
        App::bind('Shipping', function() {
            return new ShippingManager;
        });
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
