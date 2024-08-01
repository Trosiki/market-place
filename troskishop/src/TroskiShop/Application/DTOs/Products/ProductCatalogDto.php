<?php

namespace TroskiShop\Application\DTOs\Products;

use TroskiShop\Domain\Model\Product;

class ProductCatalogDto
{
    private int $id;
    private string $name;
    private string $category;
    private float $price;
    private string $image;

    /**
     * @param int $id
     * @param string $name
     * @param float $price
     */
    public function __construct(int $id, string $name, string $category, float $price, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->image = $image;
    }

    public static function createFromProduct(Product $product): self
    {
        return new self($product->getId(), $product->getName(), $product->getCategory(),$product->getPrice(), $product->getImage());
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }
}