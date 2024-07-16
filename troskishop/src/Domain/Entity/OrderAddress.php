<?php

class OrderAddress
{
    private string $country;
    private string $city;
    private string $location;
    private string $street;
    private string $number;
    private string $stair;
    private string $floorNumber;
    private string $door;
    private string $postalCode;
    private string $phoneContact;

    public function __construct()
    {
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getStair(): string
    {
        return $this->stair;
    }

    public function setStair(string $stair): void
    {
        $this->stair = $stair;
    }

    public function getFloorNumber(): string
    {
        return $this->floorNumber;
    }

    public function setFloorNumber(string $floorNumber): void
    {
        $this->floorNumber = $floorNumber;
    }

    public function getDoor(): string
    {
        return $this->door;
    }

    public function setDoor(string $door): void
    {
        $this->door = $door;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getPhoneContact(): string
    {
        return $this->phoneContact;
    }

    public function setPhoneContact(string $phoneContact): void
    {
        $this->phoneContact = $phoneContact;
    }

}