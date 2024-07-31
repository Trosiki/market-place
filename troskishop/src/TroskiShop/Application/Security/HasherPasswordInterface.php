<?php

namespace TroskiShop\Application\Security;

use Symfony\Component\Security\Core\User\UserInterface;

interface HasherPasswordInterface
{
    public function hashPassword(UserInterface $user, string $password): string;
}