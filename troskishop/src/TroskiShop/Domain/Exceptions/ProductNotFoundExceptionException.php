<?php

namespace TroskiShop\Domain\Exceptions;

class ProductNotFoundExceptionException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct('Product "' . $identifier . '" not found.');
    }
}