<?php
namespace Mage2\Framework\Attribute\Facades;

use Illuminate\Support\Facades\Facade;

class Attributes extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'attributes';
    }
}