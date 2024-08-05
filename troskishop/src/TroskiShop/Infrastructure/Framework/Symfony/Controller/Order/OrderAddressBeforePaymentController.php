<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Order;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Domain\Model\User;

class OrderAddressBeforePaymentController extends AbstractController
{
    #[Route('/order/address', name: 'order_address_before_payment', methods: ['GET'])]
    public function renderOrderAddressForm(): Response
    {
        $user = $this->getUser()?->getAppUser();
        if(!$user instanceof User) {
            $this->addFlash('error', 'Es necesario iniciar sesión para proceder al pago');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('front_pages/order/form_order_info.html.twig');
    }

}