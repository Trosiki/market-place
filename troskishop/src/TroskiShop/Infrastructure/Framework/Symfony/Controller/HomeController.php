<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Domain\Model\Product;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function indexAction(): Response
    {
        $products = [];
        for($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName("Nombre ejemplo " . $i);
            $product->setCategory("Categoria");
            $product->setDescription("Una descripción algo breve pero a la vez algo larga para ver como queda esta vaina, porque me resulta interesante ver cómo encaja con mucho texto.");
            $product->setImage('image/ejemplo.png');
            $product->setPrice(rand(0,1000));
            $products[] = $product;
        }

        return $this->render('front_pages/catalog.html.twig', [
            "products" => $products
        ]);
    }

}