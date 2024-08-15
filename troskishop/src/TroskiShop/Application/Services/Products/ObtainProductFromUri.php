<?php

namespace TroskiShop\Application\Services\Products;

use TroskiShop\Domain\Exceptions\ProductNotFoundExceptionException;
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
            throw new ProductNotFoundExceptionException($uri);
        }

        return $product;
    }

}