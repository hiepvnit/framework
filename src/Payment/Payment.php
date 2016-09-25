<?php

namespace Mage2\Framework\Payment;


abstract class Payment {

   abstract function process($orderData);
}