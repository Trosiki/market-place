<?php
namespace TroskiShop\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use TroskiShop\Application\Exceptions\CannotAddMoreProductInShoppingCart;
use TroskiShop\Application\Exceptions\ProductNotFoundException;

class ShoppingCart
{
    private int $id;
    private ?Collection $products;
    private ?string $cartStatus;
    private User $user;
    public const STATUS_ACTIVE = "Activo";
    public const STATUS_FINISHED = "Finalizado";
    public const MAX_PRODUCTS_IN_SHOPPINGCART = 3;

    public function __construct(User $user, ?string $cartStatus = self::STATUS_ACTIVE)
    {
        $this->setUser($user);
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
        $this->user->addShoppingCart($this);
    }

    /**
     * @return mixed
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }
    public function addProduct(Product $product, int $quantity): void
    {
        if($this->canAddProduct($quantity)) {
            $shoppingCartProduct = $this->filterShoppingCartProductFromProductId($product->getId());
            if($shoppingCartProduct instanceof ShoppingCartProduct) {
                $shoppingCartProduct->setQuantity($shoppingCartProduct->getQuantity() + $quantity);
            } else {
                $shoppingCartProduct = new ShoppingCartProduct($product, $quantity);
                $this->products[] = $shoppingCartProduct;
                $shoppingCartProduct->setShoppingCart($this);
            }
        } else {
            throw new CannotAddMoreProductInShoppingCart($this->getTotalProducts(), ($this->getTotalProducts()+$quantity));
        }
    }

    public function isActive(): bool
    {
        return ($this->getCartStatus() === self::STATUS_ACTIVE);
    }

    public function getTotalProducts():int
    {
        $totalProducts = 0;
        /**  @var ShoppingCartProduct $shoppingCartProduct */
        foreach($this->getProducts() as $shoppingCartProduct) {
            $totalProducts += $shoppingCartProduct->getQuantity();
        }
        return $totalProducts;
    }

    private function canAddProduct(int $quantity): bool
    {
        $newTotalProducts = $this->getTotalProducts() + $quantity;
        return ($newTotalProducts > 0 && $newTotalProducts <= self::MAX_PRODUCTS_IN_SHOPPINGCART);
    }

    private function filterShoppingCartProductFromProductId(int $productId): false|ShoppingCartProduct
    {
        return $this->products->filter(function (ShoppingCartProduct $shoppingCartProduct) use ($productId) {
           return $shoppingCartProduct->getProduct()->getId() === $productId;
        })->first();
    }

    public function getTotalPrice(): float
    {
        $totalPrice = 0;
        foreach($this->getProducts() as $shoppingCartProduct) {
            $totalPrice += $shoppingCartProduct->getTotalPrice();
        }
        return $totalPrice;
    }
}