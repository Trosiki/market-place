<?php

namespace TroskiShop\Application\Services\Order;

use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\OrderRepositoryInterface;
use TroskiShop\Domain\Repository\ShoppingCartRepositoryInterface;

class RollBackOrderCancelPayment
{
    private OrderRepositoryInterface $orderRepository;
    private ShoppingCartRepositoryInterface $shoppingCartRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, ShoppingCartRepositoryInterface $shoppingCartRepository) {
        $this->orderRepository = $orderRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function execute(User $user): Order
    {
        $order = $this->orderRepository->ofUserAndOrderStatus($user, Order::STATUS_WAITING_PAYMENT);

        $order->getShoppingCart()->setCartStatus(ShoppingCart::STATUS_ACTIVE);
        $this->shoppingCartRepository->save($order->getShoppingCart());
        $this->orderRepository->remove($order, true);

        return $order;
    }
}