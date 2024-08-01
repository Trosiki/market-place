<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\Exceptions\ProductNotFoundException;
use TroskiShop\Application\Services\Products\ObtainProductFromUri;

class DetailProductController extends AbstractController
{
    #[Route(path: '/products/{uri}', name: 'detail_product', methods: ['GET'])]
    public function detail(string $uri, ObtainProductFromUri $obtainProductFromUri): Response
    {
        try{
            $product = $obtainProductFromUri->execute($uri);
        } catch (ProductNotFoundException $e) {
            return $this->redirectToRoute('homepage');
        } catch (\Exception $e) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('/front_pages/products/detail-product.html.twig', [
            "product" => $product
        ]);
    }
}