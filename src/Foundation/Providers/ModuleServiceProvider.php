<?php

namespace Mage2\Framework\Foundation\Providers;

use Illuminate\Support\AggregateServiceProvider;
use Illuminate\Support\ServiceProvider;
use Mage2\Framework\Configuration\ConfigurationServiceProvider;
use Mage2\Framework\Payment\PaymentServiceProvider;
use Mage2\Framework\Shipping\ShippingServiceProvider;
use Mage2\Framework\AdminMenu\AdminMenuServiceProvider;
use Mage2\Framework\Theme\ThemeServiceProvider;
use Mage2\Framework\Form\FormServiceProvider;
use Mage2\Framework\DataGrid\DataGridServiceProvider;

class ModuleServiceProvider extends AggregateServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    protected $providers = [
        'Mage2\Framework\Form\FormServiceProvider',
        'Mage2\Framework\Configuration\ConfigurationServiceProvider',
        'Mage2\Framework\DataGrid\DataGridServiceProvider'
    ];

    /*
     *
     *  ConfigurationServiceProvider::class,
        PaymentServiceProvider::class,
        ShippingServiceProvider::class,
        AdminMenuServiceProvider::class,
        ThemeServiceProvider::class,

        DataGridServiceProvider::class
     */

}
