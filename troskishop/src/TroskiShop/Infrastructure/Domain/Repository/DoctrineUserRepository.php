<?php

namespace TroskiShop\Infrastructure\Domain\Repository;

use Doctrine\ORM\EntityRepository;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\UserRepositoryInterface;

class DoctrineUserRepository extends EntityRepository implements UserRepositoryInterface
{
    const ENTITY_ALIAS = 'USER';

    public function findByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function save(User $user, bool $flush = false): void
    {
        $this->getEntityManager()->persist($user);
        if($flush) {
            $this->getEntityManager()->flush();
        }
    }
}