<?php

namespace TroskiShop\Domain\Exceptions;

class CannotGenerateOrderFromNonActiveShoppingCartException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Cannot generate order from non-active shopping cart.');
    }
}