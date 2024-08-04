<?php

namespace TroskiShop\Infrastructure\Domain\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Repository\OrderRepositoryInterface;

class DoctrineOrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    const ENTITY_ALIAS = 'PRODUCT';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function save(Order $order, bool $flush = false): void
    {
        $this->getEntityManager()->persist($order);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}