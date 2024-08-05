<?php

namespace TroskiShop\Application\Services\Order;

use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\OrderRepositoryInterface;

class GetOrdersBeforeIdOfUser
{
    private OrderRepositoryInterface $orderRepository;
    public function __construct(OrderRepositoryInterface $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function execute(User $user, ?int $orderId = null): array
    {
        return $this->orderRepository->getOrdersBeforeIdOfuser($user, $orderId);
    }
}