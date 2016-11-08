<?php

namespace Mage2\Framework\System\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts);
}
