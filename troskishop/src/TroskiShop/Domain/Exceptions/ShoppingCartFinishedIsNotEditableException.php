<?php

namespace TroskiShop\Domain\Exceptions;

class ShoppingCartFinishedIsNotEditableException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Shopping Cart can\'t be edited because it is finished');
    }
}