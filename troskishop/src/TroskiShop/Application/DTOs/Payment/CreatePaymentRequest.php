<?php

namespace TroskiShop\Application\DTOs\Payment;

use TroskiShop\Domain\Model\ShoppingCart;

class CreatePaymentRequest
{
    private ShoppingCart $shoppingCart;
    private string $currency;
    private string $description;
    private string $returnUrl;
    private string $cancelUrl;

    /**
     * @param ShoppingCart $shoppingCart
     * @param string $currency
     * @param string $description
     * @param string $returnUrl
     * @param string $cancelUrl
     */
    public function __construct(ShoppingCart $shoppingCart, string $currency, string $description, string $returnUrl, string $cancelUrl)
    {
        $this->shoppingCart = $shoppingCart;
        $this->currency = $currency;
        $this->description = $description;
        $this->returnUrl = $returnUrl;
        $this->cancelUrl = $cancelUrl;
    }

    public function getShoppingCart(): ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(ShoppingCart $shoppingCart): void
    {
        $this->shoppingCart = $shoppingCart;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    public function setReturnUrl(string $returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }

    public function getCancelUrl(): string
    {
        return $this->cancelUrl;
    }

    public function setCancelUrl(string $cancelUrl): void
    {
        $this->cancelUrl = $cancelUrl;
    }

}