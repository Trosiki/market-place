<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\DTOs\Products\ProductsFilterDto;
use TroskiShop\Application\Services\Products\ObtainAllBrandsWithTotal;
use TroskiShop\Application\Services\Products\ObtainAllCategoriessWithTotal;
use TroskiShop\Application\Services\Products\ObtainProductListFromProductsFilter;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function indexAction(ObtainProductListFromProductsFilter $obtainProductListFromProductsFilter, ObtainAllBrandsWithTotal $allBrandsWithTotal, ObtainAllCategoriessWithTotal $allCategoriessWithTotal): Response
    {

        $products = $obtainProductListFromProductsFilter->execute(new ProductsFilterDto());
        $categories = $allCategoriessWithTotal->execute();
        $brands = $allBrandsWithTotal->execute();
        return $this->render('front_pages/catalog.html.twig', [
            "products" => $products->getProducts(),
            "categories" => $categories,
            "brands"     => $brands,
        ]);
    }

}