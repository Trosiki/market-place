<?php

namespace TroskiShop\Application\Services\ShoppingCart;

use TroskiShop\Application\DTOs\ShoppingCart\ProductToAddToShoppingCart;
use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Model\ShoppingCartProduct;
use TroskiShop\Domain\Repository\ProductRepositoryInterface;
use TroskiShop\Domain\Repository\ShoppingCartProductRepositoryInterface;
use TroskiShop\Domain\Repository\ShoppingCartRepositoryInterface;
use TroskiShop\Domain\Repository\UserRepositoryInterface;

class AddProductInShoppingCart
{
    private ProductRepositoryInterface $productRepository;
    private ShoppingCartRepositoryInterface $shoppingCartRepository;
    private ShoppingCartProductRepositoryInterface $shoppingCartProductRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(ProductRepositoryInterface $productRepository, ShoppingCartRepositoryInterface $shoppingCartRepository, ShoppingCartProductRepositoryInterface $shoppingCartProductRepository, UserRepositoryInterface $userRepository) {
        $this->productRepository = $productRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
        $this->shoppingCartProductRepository = $shoppingCartProductRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \TroskiShop\Application\Exceptions\CannotAddMoreProductInShoppingCart
     */
    public function execute(ProductToAddToShoppingCart $productToAddToShoppingCart)
    {
        $product = $this->productRepository->findByUri($productToAddToShoppingCart->getProductUri());
        $shoppingCart = $this->getShoppingCartOrCreateFrom($productToAddToShoppingCart);
        $shoppingCartProduct = new ShoppingCartProduct($product, $productToAddToShoppingCart->getQuantity());
        $this->shoppingCartRepository->save($shoppingCart);
        $this->shoppingCartProductRepository->save($shoppingCartProduct);
        $shoppingCart->addProduct($shoppingCartProduct);
        $this->userRepository->save($productToAddToShoppingCart->getShoppingCartOwner(), true);
    }

    private function getShoppingCartOrCreateFrom(ProductToAddToShoppingCart $productToAddToShoppingCart): ShoppingCart
    {
        $shoppingCart = $productToAddToShoppingCart->getShoppingCart();
        if(!$shoppingCart) {
            $shoppingCart = new ShoppingCart($productToAddToShoppingCart->getShoppingCartOwner());
        }
        return $shoppingCart;
    }

}