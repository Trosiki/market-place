<?php

namespace TroskiShop\Application\Services\ShoppingCart;

use TroskiShop\Application\Exceptions\ProductNotFoundException;
use TroskiShop\Domain\Model\Product;
use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Repository\ProductRepositoryInterface;
use TroskiShop\Domain\Repository\ShoppingCartProductRepositoryInterface;

class DeleteProductOfShoppingCartFromUri
{
    private ProductRepositoryInterface $productRepository;
    private ShoppingCartProductRepositoryInterface $shoppingCartProductRepository;
    public function __construct(ProductRepositoryInterface $productRepository, ShoppingCartProductRepositoryInterface $shoppingCartProductRepository)
    {
        $this->productRepository = $productRepository;
        $this->shoppingCartProductRepository = $shoppingCartProductRepository;
    }

    public function execute(ShoppingCart $shoppingCart, string $uri): void
    {
        $product = $this->productRepository->findByUri($uri);
        if(!$product instanceof Product) {
            throw new ProductNotFoundException($uri);
        }

        $shoppingCartProduct = $shoppingCart->filterShoppingCartProductFromProductId($product->getId());
        $this->shoppingCartProductRepository->remove($shoppingCartProduct, true);
    }
}