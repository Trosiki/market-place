<?php

namespace TroskiShop\Application\Services\Products;

use TroskiShop\Application\DTOs\Products\BrandDto;
use TroskiShop\Domain\Repository\ProductRepositoryInterface;

class ObtainAllBrandsWithTotal
{
    private ProductRepositoryInterface $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): array
    {
        $allBrands = $this->productRepository->countAllBrands();

        return $this->formatArrayAllBrands($allBrands);
    }

    private function formatArrayAllBrands(array $brands): array
    {
        $formattedBrands = [];
        foreach ($brands as $brand) {
            $formattedBrands[] = BrandDto::createFromArray($brand);
        }

        return $formattedBrands;
    }
}