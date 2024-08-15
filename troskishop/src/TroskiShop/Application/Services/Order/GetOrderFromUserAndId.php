<?php

namespace TroskiShop\Application\Services\Order;

use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\OrderRepositoryInterface;

class GetOrderFromUserAndId
{
    private OrderRepositoryInterface $orderRepository;
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(User $user, int $orderId): Order
    {
        $order = $this->orderRepository->ofUserAndId($user, $orderId);
        return $order;
    }
}