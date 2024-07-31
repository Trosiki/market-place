<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\DTOs\Products\ProductList;

class ListProductsController extends AbstractController
{

    #[Route('/products', 'products')]
    public function listProducts(Request $request): Response
    {
        $products = new ProductList();
        try {

        } catch (\Exception $e) {

        }

        return $this->render('front_pages/products/products-list.html.twig', [
            "products" => $products->getProducts()
        ]);
    }

}