<?php

namespace TroskiShop\Application\Services\Products;

use TroskiShop\Application\DTOs\Products\ProductList;
use TroskiShop\Application\DTOs\Products\ProductsFilterDto;
use TroskiShop\Domain\Repository\ProductRepositoryInterface;

class ObtainProductListFromProductsFilter
{

    private ProductRepositoryInterface $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(ProductsFilterDto $productsFilterDto): ProductList
    {
        $productsFiltered = $this->productRepository->listProductsFromProductFilter($productsFilterDto);
        return ProductList::createFromArrayProduct($productsFiltered);
    }

}