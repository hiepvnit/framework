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
        'Mage2\Framework\Auth\AuthServiceProvider',
        'Mage2\Framework\Form\FormServiceProvider',
        'Mage2\Framework\Configuration\ConfigurationServiceProvider',
        'Mage2\Framework\DataGrid\DataGridServiceProvider',
        'Mage2\Framework\Payment\PaymentServiceProvider',
        'Mage2\Framework\Shipping\ShippingServiceProvider',
        'Mage2\Framework\Theme\ThemeServiceProvider',
        'Mage2\Framework\AdminMenu\AdminMenuServiceProvider',
        'Mage2\Framework\Image\ImageServiceProvider',
        'Mage2\Framework\Tabs\TabsServiceProvider',
    ];

}
