<?php
namespace TroskiShop\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class ShoppingCart
{
    private int $id;
    private ?Collection $products;
    private ?string $cartStatus;
    private User $user;
    public const STATUS_ACTIVE = "Activo";
    public const STATUS_FINISHED = "Finalizado";

    public function __construct(User $user, ?string $cartStatus = self::STATUS_ACTIVE)
    {
        $this->user = $user;
        $this->cartStatus = $cartStatus;
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCartStatus(): string
    {
        return $this->cartStatus;
    }

    public function setCartStatus(string $cartStatus): void
    {
        if($cartStatus === self::STATUS_ACTIVE || $cartStatus === self::STATUS_FINISHED) {
            $this->cartStatus = $cartStatus;
        }
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
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(ShoppingCartProduct $shoppingCartProduct): void
    {
        $this->products[] = $shoppingCartProduct;
        $shoppingCartProduct->setShoppingCart($this);
    }

    public function isActive(): bool
    {
        return ($this->getCartStatus() === self::STATUS_ACTIVE);
    }
}