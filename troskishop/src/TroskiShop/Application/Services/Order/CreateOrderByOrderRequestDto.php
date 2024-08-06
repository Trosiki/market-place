<?php

namespace TroskiShop\Application\Services\Order;

use TroskiShop\Application\DTOs\Order\OrderRequestDto;
use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Model\OrderAddress;
use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Repository\OrderRepositoryInterface;
use TroskiShop\Domain\Repository\ShoppingCartRepositoryInterface;

class CreateOrderByOrderRequestDto
{

    private OrderRepositoryInterface $orderRepository;
    private ShoppingCartRepositoryInterface $shoppingCartRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, ShoppingCartRepositoryInterface $shoppingCartRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function execute(OrderRequestDto $orderRequestDto): Order
    {

        $order = $this->createOrderFromDto($orderRequestDto);
        $order->getShoppingCart()->setCartStatus(ShoppingCart::STATUS_FINISHED);
        $this->orderRepository->save($order, true);

        return $order;
    }

    private function createOrderFromDto(OrderRequestDto $orderRequestDto): Order
    {
        return new Order(
            $orderRequestDto->getShoppingCart(),
            new OrderAddress(
                $orderRequestDto->getAddressCountry(),
                $orderRequestDto->getAddressCity(),
                $orderRequestDto->getAddressLocation(),
                $orderRequestDto->getAddressStreet(),
                $orderRequestDto->getAddressNumber(),
                $orderRequestDto->getAddressStair(),
                $orderRequestDto->getAddressFloorNumber(),
                $orderRequestDto->getAddressDoor(),
                $orderRequestDto->getAddressZipCode(),
                $orderRequestDto->getAddressContactPhone()
            )
        );
    }

}