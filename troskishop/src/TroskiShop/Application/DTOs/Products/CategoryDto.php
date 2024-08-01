<?php

namespace TroskiShop\Application\DTOs\Products;

class CategoryDto
{
    private string $name;
    private int $total;

    public function __construct(string $name, int $total)
    {
        $this->name = $name;
        $this->total = $total;
    }

    public static function createFromArray(array $dataCategory): self
    {
        return new self($dataCategory['category'], $dataCategory['count']);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}