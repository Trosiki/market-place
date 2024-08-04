<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Domain\Model\User;

class DetailCartController extends AbstractController
{
    #[Route(path: '/cart', name: 'cart', methods: ['GET'])]
    public function detail(): Response
    {
        /** @var User $user */
        $user = $this->getUser()?->getAppUser();
        if(!$user instanceof User) {
            $this->addFlash('error', 'Necesita iniciar sesión para ver su carrito.');
            return $this->redirectToRoute('app_login');
        }

        if($user->getActiveShoppingCart() === false || $user->getActiveShoppingCart()->getTotalProducts() === 0) {
            $this->addFlash('error', 'Su carrito actualmente está vacío, añada productos para poder ver su detalle.');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('/front_pages/cart/detail-cart.html.twig');
    }
}