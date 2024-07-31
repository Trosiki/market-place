<?php

namespace TroskiShop\Application\DTOs\Products;

class ProductList
{
    private array $products;
    public function __construct(array $products = [])
    {
        $this->products = $products;
    }

    public static function createFromArrayProduct(array $products)
    {
        $productsList = new self();
        foreach ($products as $product) {
            $productsList->addProduct(ProductCatalogDto::createFromProduct($product));
        }
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(ProductCatalogDto $product)
    {
        $this->products[] = $product;
    }

}