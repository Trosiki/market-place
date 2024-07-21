<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/adios', name: 'adiosito')]
    public function indexAction(): Response
    {
        return new Response('<h1>Hello world!</h1>');
    }

}