<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Payment;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use TroskiShop\Application\DTOs\Order\OrderRequestDto;
use TroskiShop\Application\DTOs\Payment\CreatePaymentRequest;
use TroskiShop\Application\Services\Order\CreateOrderByOrderRequestDto;
use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Model\User;
use TroskiShop\Infrastructure\Domain\Services\PaypalPaymentGatewayService;

class CreatePaymentController extends AbstractController
{
    #[Route('create_payment', name: 'payment_create',methods: ['POST'])]
    public function createPayment(Request $request, CreateOrderByOrderRequestDto $createOrderByOrderRequestDto, PaypalPaymentGatewayService $paymentGatewayService): Response
    {
        /** @var User $user */
        $user = $this->getUser()?->getAppUser();
        if(!$user instanceof User) {
            $this->addFlash('error', 'Es necesario iniciar sesión para realizar esta acción');
            return $this->redirectToRoute('app_login');
        }

//        try {
            $orderRequestDto = $this->createOrderRequestFromRequestAndUser($request, $user);
            $order = $createOrderByOrderRequestDto->execute($orderRequestDto);
            $createPaymentRequest = $this->generatePaymentRequestFromOrder($order);
            $payment = $paymentGatewayService->createPayment($createPaymentRequest);

//        } catch (\Exception $e) {
//            $this->addFlash('error', $e->getMessage());
//            return $this->redirectToRoute('homepage');
//        }

        return $this->redirect($payment->getApprovalLink());
    }

    private function createOrderRequestFromRequestAndUser(Request $request, User $user): OrderRequestDto
    {
        return new OrderRequestDto(
            $user->getActiveShoppingCart(),
             $request->request->get('addressCountry'),
             $request->request->get('addressCity'),
             $request->request->get('addressLocation'),
             $request->request->get('addressStreet'),
             $request->request->get('addressNumber'),
             $request->request->get('addressStair'),
             $request->request->get('addressFloorNumber'),
             $request->request->get('addressDoor'),
             $request->request->get('addressZipCode'),
             $request->request->get('addressContactPhone')
        );
    }

    private function generatePaymentRequestFromOrder(Order $order): CreatePaymentRequest
    {
        return new CreatePaymentRequest(
            $order->getShoppingCart(),
            'EUR',
            $order->getShoppingCart()->getResumeShoppingCart(),
            $this->generateUrl('execute_payment', [], UrlGeneratorInterface::ABSOLUTE_URL),
            $this->generateUrl('homepage', [], UrlGeneratorInterface::ABSOLUTE_URL),
        );
    }
}