<?php

namespace TroskiShop\Domain\Exceptions;

class PasswordNonEqualsThanPasswordConfirmException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Password and Confirm Password must match.');
    }
}