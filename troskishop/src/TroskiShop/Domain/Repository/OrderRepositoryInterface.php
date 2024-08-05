<?php

namespace TroskiShop\Domain\Repository;

use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Model\User;

interface OrderRepositoryInterface
{
    public function save(Order $order, bool $flush = false): void;
    public function getOrdersBeforeIdOfuser(User $user, ?int $orderId = null): array;

    public function ofUserAndId(User $user, int $orderId): Order;
}