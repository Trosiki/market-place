<?php

class Order
{
    private string $id;
    private int $shoppingCartId;
    private int $deliveryId;
    private \DateTime $createdAt;
    private \DateTime $sendingDate;
    private \DateTime $deliveryDate;
    private \DateTime $deliveredDate;
    private OrderAddress $address;

    public function __construct()
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getShoppingCartId(): int
    {
        return $this->shoppingCartId;
    }

    public function setShoppingCartId(int $shoppingCartId): void
    {
        $this->shoppingCartId = $shoppingCartId;
    }

    public function getDeliveryId(): int
    {
        return $this->deliveryId;
    }

    public function setDeliveryId(int $deliveryId): void
    {
        $this->deliveryId = $deliveryId;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getSendingDate(): DateTime
    {
        return $this->sendingDate;
    }

    public function setSendingDate(DateTime $sendingDate): void
    {
        $this->sendingDate = $sendingDate;
    }

    public function getDeliveryDate(): DateTime
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(DateTime $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    public function getDeliveredDate(): DateTime
    {
        return $this->deliveredDate;
    }

    public function setDeliveredDate(DateTime $deliveredDate): void
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

}