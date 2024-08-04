<?php

namespace TroskiShop\Domain\Exceptions;

class EmailIsAlreadyInUseException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Email \"{$email}\" is already in use.");
    }

}