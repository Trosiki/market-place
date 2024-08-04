<?php

namespace TroskiShop\Application\DTOs\Order;

use TroskiShop\Domain\Model\Delivery;
use TroskiShop\Domain\Model\ShoppingCart;

class OrderRequestDto
{
    private ShoppingCart $shoppingCart;
    private string $addressCountry;
    private string $addressCity;
    private string $addressLocation;
    private string $addressStreet;
    private string $addressNumber;
    private string $addressStair;
    private string $addressFloorNumber;
    private string $addressDoor;
    private string $addressZipCode;
    private string $addressContactPhone;

    /**
     * @param ShoppingCart $shoppingCart
     * @param string $addressCountry
     * @param string $addressCity
     * @param string $addressLocation
     * @param string $addressStreet
     * @param string $addressNumber
     * @param string $addressStair
     * @param string $addressFloorNumber
     * @param string $addressDoor
     * @param string $addressZipCode
     * @param string $addressContactPhone
     */
    public function __construct(ShoppingCart $shoppingCart, string $addressCountry, string $addressCity, string $addressLocation, string $addressStreet, string $addressNumber, string $addressStair, string $addressFloorNumber, string $addressDoor, string $addressZipCode, string $addressContactPhone)
    {
        $this->shoppingCart = $shoppingCart;
        $this->addressCountry = $addressCountry;
        $this->addressCity = $addressCity;
        $this->addressLocation = $addressLocation;
        $this->addressStreet = $addressStreet;
        $this->addressNumber = $addressNumber;
        $this->addressStair = $addressStair;
        $this->addressFloorNumber = $addressFloorNumber;
        $this->addressDoor = $addressDoor;
        $this->addressZipCode = $addressZipCode;
        $this->addressContactPhone = $addressContactPhone;
    }

    public function getShoppingCart(): ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(ShoppingCart $shoppingCart): void
    {
        $this->shoppingCart = $shoppingCart;
    }

    public function getAddressCountry(): string
    {
        return $this->addressCountry;
    }

    public function setAddressCountry(string $addressCountry): void
    {
        $this->addressCountry = $addressCountry;
    }

    public function getAddressCity(): string
    {
        return $this->addressCity;
    }

    public function setAddressCity(string $addressCity): void
    {
        $this->addressCity = $addressCity;
    }

    public function getAddressLocation(): string
    {
        return $this->addressLocation;
    }

    public function setAddressLocation(string $addressLocation): void
    {
        $this->addressLocation = $addressLocation;
    }

    public function getAddressStreet(): string
    {
        return $this->addressStreet;
    }

    public function setAddressStreet(string $addressStreet): void
    {
        $this->addressStreet = $addressStreet;
    }

    public function getAddressNumber(): string
    {
        return $this->addressNumber;
    }

    public function setAddressNumber(string $addressNumber): void
    {
        $this->addressNumber = $addressNumber;
    }

    public function getAddressStair(): string
    {
        return $this->addressStair;
    }

    public function setAddressStair(string $addressStair): void
    {
        $this->addressStair = $addressStair;
    }

    public function getAddressFloorNumber(): string
    {
        return $this->addressFloorNumber;
    }

    public function setAddressFloorNumber(string $addressFloorNumber): void
    {
        $this->addressFloorNumber = $addressFloorNumber;
    }

    public function getAddressDoor(): string
    {
        return $this->addressDoor;
    }

    public function setAddressDoor(string $addressDoor): void
    {
        $this->addressDoor = $addressDoor;
    }

    public function getAddressZipCode(): string
    {
        return $this->addressZipCode;
    }

    public function setAddressZipCode(string $addressZipCode): void
    {
        $this->addressZipCode = $addressZipCode;
    }

    public function getAddressContactPhone(): string
    {
        return $this->addressContactPhone;
    }

    public function setAddressContactPhone(string $addressContactPhone): void
    {
        $this->addressContactPhone = $addressContactPhone;
    }


}