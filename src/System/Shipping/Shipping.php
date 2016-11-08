<?php

namespace Mage2\Framework\System\Shipping;

abstract class Shipping
{
    abstract public function process($orderData, $cartProducts);
}
