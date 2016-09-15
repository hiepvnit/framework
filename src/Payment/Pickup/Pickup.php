<?php

namespace Mage2\Framework\Payment\Pickup;

use Mage2\Framework\Payment\PaymentInterface;

class Pickup implements PaymentInterface {

    protected $identifier;
    protected $title;

    public function __construct() {
        $this->identifier = "pickup";
        $this->title = "Pickup From Store";
    }

    public function getIdentifier() {
        return $this->identifier;
    }

    public function getTitle() {
        return $this->title;
    }


}
