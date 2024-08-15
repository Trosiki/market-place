<?php

namespace TroskiShop\Infrastructure\Application\Security;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use TroskiShop\Domain\Security\HasherPasswordInterface;

class HasherPassword implements HasherPasswordInterface
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->hasher = $passwordHasher;
    }

    public function hashPassword(UserInterface $user, string $plainPassword): string {

        return $this->hasher->hashPassword(
            $user,
            $plainPassword
        );
    }
}