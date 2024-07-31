<?php

namespace TroskiShop\Application\Exceptions;

class PasswordNonEqualsThanPasswordConfirm extends \Exception
{
    public function __construct()
    {
        parent::__construct('Password and Confirm Password must match.');
    }
}