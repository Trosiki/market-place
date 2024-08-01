<?php

namespace TroskiShop\Domain\Repository;

use TroskiShop\Application\DTOs\Products\ProductsFilterDto;
use TroskiShop\Domain\Model\Product;

interface ProductRepositoryInterface
{
    public function listProductsFromProductFilter(ProductsFilterDto $productsFilterDto): array;
    public function findByUri(string $uri): Product;
    public function countAllBrands(): array;
    public function countAllCategories(): array;
}