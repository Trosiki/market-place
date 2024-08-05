<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Payment;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Infrastructure\Domain\Services\PaypalPaymentGatewayService;

class ExecutePaymentController extends AbstractController
{

    #[Route('/execute-payment', name: 'execute_payment')]
    public function executePayment(Request $request, PaypalPaymentGatewayService $paymentGatewayService)
    {
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');
        try {
            $payment = $paymentGatewayService->executePayment($paymentId, $payerId);
            dump('OLE TODO BIEN AUNQUE NO SE NI COMO');die;
        } catch (\Exception $exception) {
            dump($exception);die;
        }
    }
}