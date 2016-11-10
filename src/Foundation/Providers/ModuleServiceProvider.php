<?php

namespace Mage2\Framework\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Mage2\Framework\Configuration\ConfigurationServiceProvider;
use Mage2\Framework\Payment\PaymentServiceProvider;
use Mage2\Framework\Shipping\ShippingServiceProvider;
use Mage2\Framework\AdminMenu\AdminMenuServiceProvider;
use Mage2\Framework\Theme\ThemeServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    protected $providers = [
        ConfigurationServiceProvider::class,
        PaymentServiceProvider::class,
        ShippingServiceProvider::class,
        AdminMenuServiceProvider::class,
        ThemeServiceProvider::class,
    ];

}
