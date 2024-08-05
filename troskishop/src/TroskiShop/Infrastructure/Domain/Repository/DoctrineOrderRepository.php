<?php

namespace TroskiShop\Infrastructure\Domain\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\OrderRepositoryInterface;

class DoctrineOrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    const ENTITY_ALIAS = 'SHOP_ORDER';

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

    public function getOrdersBeforeIdOfuser(User $user, ?int $orderId = null): array
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->leftJoin('o.shoppingCart','sc')
            ->leftJoin('sc.products','scp')
            ->leftJoin('scp.product','p')
            ->addSelect('sc','sc','scp','p')
            ->where('sc.user = :user')
            ->setParameter('user', $user);

        if(!empty($orderId))
        {
            $queryBuilder->andWhere('o.id < :orderId')
                ->setParameter('orderId', $orderId);
        }

        return $queryBuilder->orderBy('o.id', 'DESC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }

    public function ofUserAndId(User $user, int $orderId): Order
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.shoppingCart','sc')
            ->leftJoin('sc.products','scp')
            ->leftJoin('scp.product','p')
            ->addSelect('sc','sc','scp','p')
            ->where('sc.user = :user')
            ->setParameter('user', $user)
            ->andWhere('o.id < :orderId')
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}