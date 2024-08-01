<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\DTOs\Products\ProductList;
use TroskiShop\Application\DTOs\Products\ProductsFilterDto;
use TroskiShop\Application\Services\Products\ObtainProductListFromProductsFilter;

class ListProductsController extends AbstractController
{

    #[Route('/products', 'products')]
    public function listProducts(Request $request, ObtainProductListFromProductsFilter $obtainProductListFromProductsFilter): Response
    {
        $products = new ProductList();
        try {
            $productsFilter = $this->createProductsFilterFromRequest($request);
            $products = $obtainProductListFromProductsFilter->execute($productsFilter);
        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
        }

        return $this->render('front_pages/products/products-list.html.twig', [
            "products" => $products->getProducts()
        ]);
    }

    private function createProductsFilterFromRequest(Request $request)
    {
        return new ProductsFilterDto(
            $request->request->get('name'),
            $request->request->get('category'),
            (float) $request->request->get('priceMin'),
            (float) $request->request->get('priceMax'),
            $request->request->get('brand')
        );
    }

}