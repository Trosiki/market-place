<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function indexAction(): Response
    {
        return $this->render('base.html.twig');
    }

}