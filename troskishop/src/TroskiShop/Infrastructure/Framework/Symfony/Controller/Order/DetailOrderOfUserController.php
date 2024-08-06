<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Order;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\Services\Order\GetOrderFromUserAndId;
use TroskiShop\Application\Services\Order\GetOrdersBeforeIdOfUser;
use TroskiShop\Domain\Model\User;

class DetailOrderOfUserController extends AbstractController
{
    #[Route('detail-order/{orderId}', name: 'detail_order', methods: ['GET'])]
    public function detailOrderOfUser(int $orderId, GetOrderFromUserAndId $getOrderFromUserAndId): Response
    {
        $user = $this->getUser()?->getAppUser();
        if(!$user instanceof User) {
            $this->addFlash('error', 'No puedes ver el detalle del pedido sin iniciar sesión');
            return $this->redirectToRoute('app_login');
        }

        $order = $getOrderFromUserAndId->execute($user, $orderId);

        return $this->render('front_pages/order/detail.html.twig', ['order' => $order]);
    }

}