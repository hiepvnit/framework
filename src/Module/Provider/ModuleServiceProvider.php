<?php

namespace Mage2\Framework\Module\Provider;

use Illuminate\Support\ServiceProvider;
use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\App;
use Mage2\Framework\View\AdminMenu;
use Mage2\Framework\Shipping\ShippingManager;
use Mage2\Framework\Payment\PaymentManager;

class ModuleServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->registerAdminMenuFacade();
        $this->registerExtension();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->_registerShippingFacade();
        $this->_registerPaymentFacade();
    }

    public function registerExtension() {

        $mage2Module = [
            "Mage2\\Common\\" => base_path('/modules/base/Mage2/Common'),
            "Mage2\\Cart\\" => base_path('/modules/base/Mage2/Cart'),
            "Mage2\\Install\\" => base_path('/modules/base/Mage2/Install'),
            "Mage2\\Catalog\\" => base_path('/modules/base/Mage2/Catalog'),
            "Mage2\\Order\\" => base_path('/modules/base/Mage2/Order'),
            "Mage2\\Attribute\\" => base_path('/modules/base/Mage2/Attribute'),
            "Mage2\\Address\\" => base_path('/modules/base/Mage2/Address'),
            "Mage2\\User\\" => base_path('/modules/base/Mage2/User'),
            "Mage2\\TaxClass\\" => base_path('/modules/base/Mage2/TaxClass'),
            "Mage2\\Wishlist\\" => base_path('/modules/base/Mage2/Wishlist'),
            "Mage2\\Checkout\\" => base_path('/modules/base/Mage2/Checkout'),
        ];

        foreach ($mage2Module as $namespace => $path ) {

            //var_dump($namespace);
            //var_dump($path);

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

}
