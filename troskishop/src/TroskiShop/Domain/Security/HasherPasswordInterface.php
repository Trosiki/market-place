<?php

namespace TroskiShop\Domain\Security;

use Symfony\Component\Security\Core\User\UserInterface;

interface HasherPasswordInterface
{
    public function hashPassword(UserInterface $user, string $plainPassword): string;
}