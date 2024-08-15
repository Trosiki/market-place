<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Payment;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\Services\Order\RollBackOrderCancelPayment;
use TroskiShop\Application\Services\Order\UpdateOrderStatusPaymentDone;
use TroskiShop\Domain\Model\User;
use TroskiShop\Infrastructure\Domain\Services\PaypalPaymentGatewayService;

class ExecutePaymentController extends AbstractController
{

    #[Route('/execute-payment', name: 'execute_payment')]
    public function executePayment(Request $request, PaypalPaymentGatewayService $paymentGatewayService, UpdateOrderStatusPaymentDone $updateOrderStatusPaymentDone, RollBackOrderCancelPayment $rollBackOrderCancelPayment)
    {
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');
        $user = $this->getUser()->getAppUser();
        if(!$user instanceof User) {
            $this->addFlash('error', 'Necesita iniciar sesión para ver su carrito.');
            return $this->redirectToRoute('app_login');
        }

        try {
            $payment = $paymentGatewayService->executePayment($paymentId, $payerId);
            $order = $updateOrderStatusPaymentDone->execute($user, $paymentId);
        } catch (\Exception $exception) {
            $rollBackOrderCancelPayment->execute($user);
            $this->addFlash('error','Se ha cancelado el pago, por favor intentelo más tarde');
            return $this->redirectToRoute('cart');
        }

        $this->addFlash('success','Pedido realizado correctamente');
        return $this->redirectToRoute('detail_order', ['orderId' => $order->getId()]);
    }
}