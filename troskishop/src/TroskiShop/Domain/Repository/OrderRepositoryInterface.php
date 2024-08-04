<?php

namespace TroskiShop\Domain\Repository;

use TroskiShop\Domain\Model\Order;

interface OrderRepositoryInterface
{
    public function save(Order $order, bool $flush = false): void;
}