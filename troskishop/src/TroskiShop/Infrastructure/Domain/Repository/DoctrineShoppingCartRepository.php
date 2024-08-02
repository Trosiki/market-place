<?php

namespace TroskiShop\Infrastructure\Domain\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Repository\ShoppingCartRepositoryInterface;

class DoctrineShoppingCartRepository extends ServiceEntityRepository implements ShoppingCartRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingCart::class);
    }

    public function save(ShoppingCart $shoppingCart, bool $flush = false): void
    {
        $this->getEntityManager()->persist($shoppingCart);
        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function beginTransaction(): void
    {
        $this->getEntityManager()->beginTransaction();
    }

    public function commit(): void
    {
        $this->getEntityManager()->commit();
    }

    public function rollbackTransaction(): void
    {
        $this->getEntityManager()->rollback();
    }
}