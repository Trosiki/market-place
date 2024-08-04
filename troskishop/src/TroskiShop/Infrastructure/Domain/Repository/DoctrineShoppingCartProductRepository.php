<?php

namespace TroskiShop\Infrastructure\Domain\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use TroskiShop\Domain\Model\ShoppingCartProduct;
use TroskiShop\Domain\Repository\ShoppingCartProductRepositoryInterface;

class DoctrineShoppingCartProductRepository extends ServiceEntityRepository implements ShoppingCartProductRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingCartProduct::class);
    }

    public function save(ShoppingCartProduct $shoppingCartProduct, bool $flush = false): void
    {
        $this->getEntityManager()->persist($shoppingCartProduct);
        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ShoppingCartProduct $shoppingCartProduct, bool $flush = false): void
    {
        $this->getEntityManager()->remove($shoppingCartProduct);
        if($flush) {
            $this->getEntityManager()->flush();
        }
    }
}