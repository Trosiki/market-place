<?php

namespace TroskiShop\Domain\Repository;

use TroskiShop\Application\DTOs\Products\ProductsFilterDto;

interface ProductRepositoryInterface
{
    public function listProductsFromProductFilter(ProductsFilterDto $productsFilterDto): array;
}