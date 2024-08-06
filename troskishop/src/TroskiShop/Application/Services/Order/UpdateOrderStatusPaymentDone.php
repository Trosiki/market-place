<?php

namespace TroskiShop\Application\Services\Order;

use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\OrderRepositoryInterface;

class UpdateOrderStatusPaymentDone
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function execute(User $user, int $paymentId): Order
    {
        $order = $this->orderRepository->ofUserAndOrderStatus($user, Order::STATUS_PAYMENT_CONFIRMED);

        $order->setPaymentId($paymentId);
        $order->setOrderStatus(Order::STATUS_PAYMENT_CONFIRMED);

        $this->orderRepository->save($order, true);

        return $order;
    }
}