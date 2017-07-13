<?php

namespace Mage2\Framework\Tabs\Facades;

use Illuminate\Support\Facades\Facade;

class Tabs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Framework\Tabs\TabsMaker';
    }
}
