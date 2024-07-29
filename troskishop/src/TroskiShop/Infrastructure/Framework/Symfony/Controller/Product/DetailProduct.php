<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Domain\Model\Product;

class DetailProduct extends AbstractController
{
    #[Route(path: '/detail', name: 'detail_product', methods: ['GET'])]
    public function detail(Product $product): Response
    {
        return $this->render('/front_pages/products/detail-product.html.twig', []);
    }
}