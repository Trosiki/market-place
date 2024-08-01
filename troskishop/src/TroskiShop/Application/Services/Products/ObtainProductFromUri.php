<?php

namespace TroskiShop\Application\Services\Products;

use TroskiShop\Application\Exceptions\ProductNotFoundException;
use TroskiShop\Domain\Repository\ProductRepositoryInterface;

class ObtainProductFromUri
{

    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(string $uri)
    {
        $product = $this->productRepository->findByUri($uri);
        if (empty($product)) {
            throw new ProductNotFoundException($uri);
        }

        return $product;
    }

}