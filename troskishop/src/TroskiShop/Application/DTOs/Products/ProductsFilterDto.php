<?php

namespace TroskiShop\Application\DTOs\Products;

class ProductsFilterDto
{
    private string $nameProduct;
    private string $category;
    private float $priceMin;
    private float $priceMax;

    public function __construct(string $nameProduct, string $category, float $priceMin, float $priceMax)
    {
        $this->nameProduct = $nameProduct;
        $this->category = $category;
        $this->priceMin = $priceMin;
        $this->priceMax = $priceMax;
    }

    public function getNameProduct(): string
    {
        return $this->nameProduct;
    }

    public function setNameProduct(string $nameProduct): void
    {
        $this->nameProduct = $nameProduct;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getPriceMin(): float
    {
        return $this->priceMin;
    }

    public function setPriceMin(float $priceMin): void
    {
        $this->priceMin = $priceMin;
    }

    public function getPriceMax(): float
    {
        return $this->priceMax;
    }

    public function setPriceMax(float $priceMax): void
    {
        $this->priceMax = $priceMax;
    }

}