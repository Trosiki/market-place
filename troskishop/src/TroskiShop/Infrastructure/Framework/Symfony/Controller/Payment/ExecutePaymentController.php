<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Payment;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\Services\Order\UpdateOrderStatusPaymentDone;
use TroskiShop\Infrastructure\Domain\Services\PaypalPaymentGatewayService;

class ExecutePaymentController extends AbstractController
{

    #[Route('/execute-payment', name: 'execute_payment')]
    public function executePayment(Request $request, PaypalPaymentGatewayService $paymentGatewayService, UpdateOrderStatusPaymentDone $updateOrderStatusPaymentDone)
    {
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');
        try {
            $user = $this->getUser()->getAppUser();
            $payment = $paymentGatewayService->executePayment($paymentId, $payerId);
            $order = $updateOrderStatusPaymentDone->execute($user, $paymentId);
        } catch (\Exception $exception) {
            $this->addFlash('error','Se ha cancelado el pago, por favor intentelo más tarde');
            return $this->redirectToRoute('cart');
        }

        $this->addFlash('success','Pedido realizado correctamente');
        return $this->redirectToRoute('detail_product', ['orderId' => $order->getId()]);
    }
}