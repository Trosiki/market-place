<?php
namespace App\Domain\Model;

class ShoppingCart
{
    private int $id;
    private array $products;
    private CartStatus $cartStatus;
    private User $user;

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

    public function getCartStatus(): CartStatus
    {
        return $this->cartStatus;
    }

    public function setCartStatus(CartStatus $cartStatus): void
    {
        $this->cartStatus = $cartStatus;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(ShoppingCartProduct $product): void
    {
        $this->products[] = $product;
        $product->setShoppingCart($this); // Ensure bidirectional relationship
    }

    public function removeProduct(ShoppingCartProduct $product): void
    {
        foreach ($this->products as $key => $p) {
            if ($p === $product) {
                unset($this->products[$key]);
                $product->setShoppingCart(null); // Ensure bidirectional relationship
                break;
            }
        }
    }
}