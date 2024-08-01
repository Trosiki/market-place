<?php

namespace TroskiShop\Application\Exceptions;

class ProductNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct('Product "' . $identifier . '" not found.');
    }
}