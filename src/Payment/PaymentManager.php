<?php
namespace Mage2\Framework\Payment;

use Mage2\Framework\Payment\Pickup\Pickup;
use Illuminate\Support\Collection;
class PaymentManager {

    public $paymentOption;

    public function all() {
        $this->paymentOption = Collection::make([]);
        $class = new Pickup();
        $this->paymentOption->push($class);
        
        return $this->paymentOption;
    }

    
}