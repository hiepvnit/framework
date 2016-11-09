<?php

namespace Mage2\Framewor\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts);
}
