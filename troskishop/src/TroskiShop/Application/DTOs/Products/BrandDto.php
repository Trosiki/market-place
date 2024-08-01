<?php

namespace TroskiShop\Application\DTOs\Products;

class BrandDto
{
    private string $name;
    private int $total;

    public function __construct(string $name, int $total)
    {
        $this->name = $name;
        $this->total = $total;
    }

    public static function createFromArray(array $dataBrand): self
    {
        return new self($dataBrand['brand'], $dataBrand['count']);
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