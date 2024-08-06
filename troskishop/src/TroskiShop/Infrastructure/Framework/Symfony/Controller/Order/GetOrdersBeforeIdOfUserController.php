<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Order;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\Services\Order\GetOrdersBeforeIdOfUser;
use TroskiShop\Domain\Model\User;

class GetOrdersBeforeIdOfUserController extends AbstractController
{
    #[Route('/orders-before/{orderId}', name: 'get_orders_before_id_of_user', methods: ['GET'])]
    public function getOrdersBeforeIdOfuser(int $orderId, GetOrdersBeforeIdOfUser $getOrdersBeforeIdOfUser): Response
    {
        $user = $this->getUser()?->getAppUser();
        if($user instanceof User) {
            return new Response();
        }

        $orders = $getOrdersBeforeIdOfUser->execute($user, $orderId);

        return $this->render('front_pages/order/order-row.html.twig', [
            'orders' => $orders,
        ]);
    }

}