<?php

namespace Mage2\Framework\System\Payment;

interface PaymentInterface
{
    public function getIdentifier();

    public function getTitle();
}
