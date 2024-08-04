<?php

namespace TroskiShop\Domain\Exceptions;

use TroskiShop\Domain\Model\ShoppingCart;

class CannotAddMoreProductInShoppingCartException extends \Exception
{
    private int $actualTotal;
    private int $newTotal;
    public function __construct(int $actualTotal, int $newTotal)
    {
        parent::__construct("You cannot exceed the maximum number of products set (". ShoppingCart::MAX_PRODUCTS_IN_SHOPPINGCART ."), you currently have '$actualTotal' and are trying to have '$newTotal'");
        $this->actualTotal = $actualTotal;
        $this->newTotal = $newTotal;
    }

    public function getActualTotal(): int
    {
        return $this->actualTotal;
    }

    public function getNewTotal(): int
    {
        return $this->newTotal;
    }

}