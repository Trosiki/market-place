<?php

namespace TroskiShop\Domain\Exceptions;

class PaymentProgressWrongException extends \Exception
{

    public function __construct(string $message)
    {
        parent::__construct('[TROSKISHOP][PAYMENT] PaymentProgress wrong: ' . $message);
    }

}