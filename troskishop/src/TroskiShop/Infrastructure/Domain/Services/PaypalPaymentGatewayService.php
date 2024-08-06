<?php

namespace TroskiShop\Infrastructure\Domain\Services;

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use TroskiShop\Application\DTOs\Payment\CreatePaymentRequest;
use TroskiShop\Domain\Exceptions\PaymentProgressWrongException;

class PaypalPaymentGatewayService
{
    private ApiContext $apiContext;
    public const PAYMENT_METHOD = 'paypal';
    public const INTENT = 'sale';

    public function __construct(string $clientId, string $clientSecret, string $mode)
    {
        $this->apiContext = new ApiContext(new OAuthTokenCredential($clientId, $clientSecret));
        $this->apiContext->setConfig([
            'mode' => $mode
        ]);
    }

    public function createPayment(CreatePaymentRequest $createPaymentRequest): Payment
    {
        $payer = new Payer();
        $payer->setPaymentMethod(self::PAYMENT_METHOD);
        $totalPrice = $createPaymentRequest->getShoppingCart()->getTotalPrice();

        $amount = $this->generateAmountByTotalAndCurrency($totalPrice, $createPaymentRequest->getCurrency());

        $transaction = $this->createTransactionWith($amount, $createPaymentRequest->getDescription());

        $payment = $this->generatePaymentBy($payer, $transaction, $createPaymentRequest->getReturnUrl(), $createPaymentRequest->getCancelUrl());

        try {
//            dump($this->apiContext);die;
            $payment->create($this->apiContext);
        } catch (\Exception $e) {
            throw new PaymentProgressWrongException($e->getMessage());
        }

        return $payment;
    }

    public function executePayment(string $paymentId, string $payerId): Payment
    {
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
        } catch (\Exception $e) {
            throw new PaymentProgressWrongException($e->getMessage());
        }

        return $result;
    }

    private function generateAmountByTotalAndCurrency(float $totalPrice, string $currency): Amount
    {
        $amount = new Amount();
        $amount->setCurrency($currency);
        $amount->setTotal($totalPrice);
        return $amount;
    }

    private function generatePaymentBy(Payer $payer, Transaction $transaction, string $returnUrl, string $cancelUrl): Payment
    {
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($returnUrl)
                ->setCancelUrl($cancelUrl);

        $payment = new Payment();
        $payment->setIntent(self::INTENT)
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        return $payment;
    }

    private function createTransactionWith(Amount $amount, string $description): Transaction
    {
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription($description);

        return $transaction;
    }
}