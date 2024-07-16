<?php

class ShoppingCartProduct
{
    private int $id;
    private Product $product;
    private ShoppingCart $shoppingCart;
    private int $quantity;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getShoppingCart(): ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(ShoppingCart $shoppingCart): void
    {
        $this->shoppingCart = $shoppingCart;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getTotalPrice(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }
}