<?php

namespace Mage2\Framework\Shipping;


abstract class Shipping {

   abstract function process($orderData, $cartProducts);
}