<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DetailCartController extends AbstractController
{
    #[Route(path: '/cart', name: 'cart', methods: ['GET'])]
    public function detail(): Response
    {
        return $this->render('/front_pages/cart/detail-cart.html.twig');
    }
}