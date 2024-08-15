<?php

namespace TroskiShop\Domain\Repository;

use TroskiShop\Domain\Model\ShoppingCart;

interface ShoppingCartRepositoryInterface
{
    public function save(ShoppingCart $shoppingCart, bool $flush = false): void;

    public function beginTransaction(): void;
    public function commit(): void;
    public function rollbackTransaction(): void;
}