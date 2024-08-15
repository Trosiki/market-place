<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Order;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\Services\Order\GetOrdersBeforeIdOfUser;
use TroskiShop\Domain\Model\User;

class ViewMyOrdersController extends AbstractController
{
    #[Route('/my-orders', name: 'my_orders', methods: ['GET'])]
    public function viewMyOrders(GetOrdersBeforeIdOfUser $getOrdersBeforeIdOfUser): Response
    {
        $user = $this->getUser()?->getAppUser();
        if(!$user instanceof User)
        {
            $this->addFlash('error','Es necesario iniciar sesión para ver tus pedidos');
            return $this->redirectToRoute('app_login');
        }

        $orders = $getOrdersBeforeIdOfUser->execute($user);

        return $this->render('front_pages/order/my_orders.html.twig', [
            'orders' => $orders
        ]);
    }

}