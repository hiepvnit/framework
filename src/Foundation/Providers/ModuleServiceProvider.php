<?php

namespace Mage2\Framework\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Mage2\Framework\Configuration\ConfigurationServiceProvider;
use Mage2\Framework\Payment\PaymentServiceProvider;
use Mage2\Framework\Shipping\ShippingServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * @todo not using this feature now
     * Register Custom Extension and add Namespace into Class Loader
     *
     * @return void
     */
    public function registerModule()
    {
        //$mage2Module = config('module');
        //foreach ($mage2Module as $namespace => $path) {
        //    $loader = new ClassLoader();
        //    $loader->addPsr4($namespace, $path);
        //    $loader->register();
        //    //Register ServiceProvider for Modules
        //    $extensionProvider = str_replace('\\', '', $namespace.'ServiceProvider');
        //    App::register($namespace.$extensionProvider);
        //}
    }

    protected $providers = [
        ConfigurationServiceProvider::class,
        PaymentServiceProvider::class,
        ShippingServiceProvider::class,
    ];

}
