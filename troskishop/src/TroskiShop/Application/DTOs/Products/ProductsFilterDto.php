<?php

namespace TroskiShop\Application\DTOs\Products;

class ProductsFilterDto
{
    private ?string $nameProduct;
    private ?string $category;
    private ?float $priceMin;
    private ?float $priceMax;
    private ?int $lastProductId;
    private bool $active;

    public function __construct(?string $nameProduct = null, ?string $category = null, ?float $priceMin = null, ?float $priceMax = null, ?int $idOfLastProduct = null, $active = true)
    {
        $this->nameProduct = $nameProduct;
        $this->category = $category;
        $this->priceMin = $priceMin;
        $this->priceMax = $priceMax;
        $this->lastProductId = $idOfLastProduct;
        $this->active = $active;
    }

    public function getNameProduct(): ?string
    {
        return $this->nameProduct;
    }

    public function setNameProduct(string $nameProduct): void
    {
        $this->nameProduct = $nameProduct;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getPriceMin(): ?float
    {
        return $this->priceMin;
    }

    public function setPriceMin(float $priceMin): void
    {
        $this->priceMin = $priceMin;
    }

    public function getPriceMax(): ?float
    {
        return $this->priceMax;
    }

    public function setPriceMax(float $priceMax): void
    {
        $this->priceMax = $priceMax;
    }

    public function getLastProductId(): ?int
    {
        return $this->lastProductId;
    }

    public function setLastProductId($lastProductId): void
    {
        $this->lastProductId = $lastProductId;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

}