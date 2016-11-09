<?php

namespace Mage2\Framework\Theme\Facade;

use Illuminate\Support\Facades\Facade;

class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Framework\Theme\ThemeManager';
    }
}
