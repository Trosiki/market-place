<?php

namespace TroskiShop\Application\Services\Products;

use TroskiShop\Application\DTOs\Products\CategoryDto;
use TroskiShop\Domain\Repository\ProductRepositoryInterface;

class ObtainAllCategoriessWithTotal
{
    private ProductRepositoryInterface $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): array
    {
        $allCategories = $this->productRepository->countAllCategories();

        return $this->formatArrayAllCategories($allCategories);
    }

    private function formatArrayAllCategories(array $categories): array
    {
        $formattedCategories = [];
        foreach ($categories as $category) {
            $formattedCategories[] = CategoryDto::createFromArray($category);
        }

        return $formattedCategories;
    }
}