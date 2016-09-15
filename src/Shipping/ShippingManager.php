<?php
namespace Mage2\Framework\Shipping;

use Mage2\Framework\Shipping\FreeShipping\FreeShipping;
use Illuminate\Support\Collection;
class ShippingManager {

    public $shippingOption;

    public function all() {
        $this->shippingOptions = Collection::make([]);
        $class = new FreeShipping();
        $this->shippingOptions->push($class);
        
        return $this->shippingOptions;
    }

    
}