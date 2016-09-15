<?php
namespace Mage2\Framework\Shipping\Facade;

use Illuminate\Support\Facades\Facade;

class Shipping extends Facade{
    protected static function getFacadeAccessor() { return 'Shipping'; }
}