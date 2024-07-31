<?php

namespace TroskiShop\Application\Exceptions;

class EmailIsAlreadyInUse extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Email \"{$email}\" is already in use.");
    }

}