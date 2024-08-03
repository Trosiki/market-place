<?php

namespace TroskiShop\Application\Services\ShoppingCart;

use TroskiShop\Application\DTOs\ShoppingCart\ProductToAddToShoppingCart;
use TroskiShop\Application\Exceptions\ProductNotFoundException;
use TroskiShop\Domain\Model\Product;
use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Repository\ProductRepositoryInterface;
use TroskiShop\Domain\Repository\ShoppingCartRepositoryInterface;

class AddProductInShoppingCart
{
    private ProductRepositoryInterface $productRepository;
    private ShoppingCartRepositoryInterface $shoppingCartRepository;

    public function __construct(ProductRepositoryInterface $productRepository, ShoppingCartRepositoryInterface $shoppingCartRepository) {
        $this->productRepository = $productRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    /**
     * @throws \TroskiShop\Application\Exceptions\CannotAddMoreProductInShoppingCart
     * @throws ProductNotFoundException
     */
    public function execute(ProductToAddToShoppingCart $productToAddToShoppingCart)
    {
        $product = $this->productRepository->findByUri($productToAddToShoppingCart->getProductUri());

        if(!$product instanceof Product) {
            throw new ProductNotFoundException($productToAddToShoppingCart->getProductUri());
        }

        $shoppingCart = $this->getShoppingCartOrCreateFrom($productToAddToShoppingCart);
        $shoppingCart->addProduct($product, $productToAddToShoppingCart->getQuantity());
        $this->shoppingCartRepository->save($shoppingCart, true);
    }

    private function getShoppingCartOrCreateFrom(ProductToAddToShoppingCart $productToAddToShoppingCart): ShoppingCart
    {
        $shoppingCart = $productToAddToShoppingCart->getShoppingCart();
        if(!$shoppingCart) {
            $shoppingCart = new ShoppingCart($productToAddToShoppingCart->getShoppingCartOwner());
            $this->shoppingCartRepository->save($shoppingCart);
        }
        return $shoppingCart;
    }

}