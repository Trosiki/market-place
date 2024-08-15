<?php

namespace TroskiShop\Infrastructure\Domain\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\UserRepositoryInterface;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    const ENTITY_ALIAS = 'USER';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

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

    public function findWithActiveShoppingCartByEmail(string $email): ?User
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.shoppingCarts', 'sc')
            ->leftJoin('sc.products', 'scp')
            ->leftJoin('scp.product', 'p')
            ->addSelect('sc','scp','p')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()->getOneOrNullResult();
    }
}