<?php

namespace TroskiShop\Domain\Repository;

use TroskiShop\Domain\Model\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function save(User $user): void;
}