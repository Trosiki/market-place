<?php
namespace TroskiShop\Domain\Model;

use TroskiShop\Domain\Exceptions\CannotGenerateOrderFromNonActiveShoppingCartException;

class Order
{
    private int $id;
    private ShoppingCart $shoppingCart;
    private ?Delivery $delivery = null;
    private \DateTime $createdAt;
    private ?\DateTime $sendingDate = null;
    private ?\DateTime $deliveryDate = null;
    private ?\DateTime $deliveredDate = null;
    private OrderAddress $address;
    private string $orderStatus;
    private ?string $paymentId = null;
    public const STATUS_WAITING_PAYMENT = 'Pago en progreso';
    public const STATUS_PAYMENT_CONFIRMED = 'Confirmado';

    public function __construct(ShoppingCart $shoppingCart, OrderAddress $address, string $orderStatus = self::STATUS_WAITING_PAYMENT)
    {
        $this->setShoppingCart($shoppingCart);
        $this->address = $address;
        $this->createdAt = new \DateTime();
        $this->orderStatus = $orderStatus;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getShoppingCart(): ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(ShoppingCart $shoppingCart): void
    {
        if(!$shoppingCart->isActive()) {
            throw new CannotGenerateOrderFromNonActiveShoppingCartException();
        }

        $this->shoppingCart = $shoppingCart;
    }

    public function getDeliveryId(): int
    {
        return $this->deliveryId;
    }

    public function setDeliveryId(int $deliveryId): void
    {
        $this->deliveryId = $deliveryId;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getSendingDate(): ?\DateTime
    {
        return $this->sendingDate;
    }

    public function setSendingDate(\DateTime $sendingDate): void
    {
        $this->sendingDate = $sendingDate;
    }

    public function getDeliveryDate(): ?\DateTime
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTime $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    public function getDeliveredDate(): ?\DateTime
    {
        return $this->deliveredDate;
    }

    public function setDeliveredDate(\DateTime $deliveredDate): void
    {
        $this->deliveredDate = $deliveredDate;
    }

    public function getAddress(): OrderAddress
    {
        return $this->address;
    }

    public function setAddress(OrderAddress $address): void
    {
        $this->address = $address;
    }

    public function getDelivery(): ?Delivery
    {
        return $this->delivery;
    }

    public function setDelivery(?Delivery $delivery): void
    {
        $this->delivery = $delivery;
    }

    public function getOrderStatus(): string
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(string $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }

    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    public function setPaymentId(?string $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

}