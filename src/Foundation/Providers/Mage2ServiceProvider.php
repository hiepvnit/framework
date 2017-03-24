<?php

namespace Mage2\Framework\Foundation\Providers;

use Illuminate\Support\AggregateServiceProvider;


class Mage2ServiceProvider extends AggregateServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    protected $providers = [
        \Mage2\Framework\Auth\AuthServiceProvider::class,
        \Mage2\Framework\Form\FormServiceProvider::class,
        \Mage2\Framework\Configuration\ConfigurationServiceProvider::class,
        \Mage2\Framework\DataGrid\DataGridServiceProvider::class,
        \Mage2\Framework\Payment\PaymentServiceProvider::class,
        \Mage2\Framework\Shipping\ShippingServiceProvider::class,
        \Mage2\Framework\Theme\ThemeServiceProvider::class,
        \Mage2\Framework\AdminMenu\AdminMenuServiceProvider::class,
        \Mage2\Framework\Module\ModuleServiceProvider::class,
        \Mage2\Framework\Image\ImageServiceProvider::class,
    ];

}
