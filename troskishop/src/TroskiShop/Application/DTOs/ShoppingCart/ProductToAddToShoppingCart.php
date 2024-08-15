<?php

namespace TroskiShop\Application\DTOs\ShoppingCart;

use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Model\User;

class ProductToAddToShoppingCart
{
    private User $shoppingCartOwner;
    private string $productUri;
    private int $quantity;
    private ShoppingCart|false $shoppingCart;

    /**
     * @param User $shoppingCartOwner
     * @param string $productUri
     * @param int $quantity
     * @param false|ShoppingCart $shoppingCart
     */
    public function __construct(User $shoppingCartOwner, string $productUri, int $quantity, false|ShoppingCart $shoppingCart)
    {
        $this->shoppingCartOwner = $shoppingCartOwner;
        $this->productUri = $productUri;
        $this->quantity = $quantity;
        $this->shoppingCart = $shoppingCart;
    }

    public function getShoppingCartOwner(): User
    {
        return $this->shoppingCartOwner;
    }

    public function getProductUri(): string
    {
        return $this->productUri;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getShoppingCart(): false|ShoppingCart
    {
        return $this->shoppingCart;
    }

}