<?php

namespace TroskiShop\Domain\Repository;

use TroskiShop\Domain\Model\ShoppingCartProduct;

interface ShoppingCartProductRepositoryInterface
{
    public function save(ShoppingCartProduct $shoppingCartProduct, bool $flush = false): void;
    public function remove(ShoppingCartProduct $shoppingCartProduct, bool $flush = false): void;
}