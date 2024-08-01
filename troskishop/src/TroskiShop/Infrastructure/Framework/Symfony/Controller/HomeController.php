<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\DTOs\Products\ProductsFilterDto;
use TroskiShop\Application\Services\Products\ObtainAllBrandsWithTotal;
use TroskiShop\Application\Services\Products\ObtainAllCategoriessWithTotal;
use TroskiShop\Application\Services\Products\ObtainProductListFromProductsFilter;
use TroskiShop\Domain\Model\Product;
use TroskiShop\Domain\Model\ShoppingCartProduct;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function indexAction(ObtainProductListFromProductsFilter $obtainProductListFromProductsFilter, ObtainAllBrandsWithTotal $allBrandsWithTotal, ObtainAllCategoriessWithTotal $allCategoriessWithTotal): Response
    {
        $shoppingCartProducts = [];
        $totalPrice = 0;
        for($i = 0; $i < 3; $i++) {
            $shoppingCartProduct = new ShoppingCartProduct();
            $product = new Product();
            $product->setName("Nombre ejemplo " . $i);
            $product->setCategory("Categoria");
            $product->setDescription("Una descripción algo breve pero a la vez algo larga para ver como queda esta vaina, porque me resulta interesante ver cómo encaja con mucho texto.");
            $product->setImage('image/Products/ejemplo.png');
            $product->setPrice(rand(0,1000));

            $shoppingCartProduct->setProduct($product);
            $shoppingCartProduct->setQuantity(1);
            $shoppingCartProducts[] = $shoppingCartProduct;
            $totalPrice += $product->getPrice();
        }

        $products = $obtainProductListFromProductsFilter->execute(new ProductsFilterDto());
        $categories = $allCategoriessWithTotal->execute();
        $brands = $allBrandsWithTotal->execute();
        return $this->render('front_pages/catalog.html.twig', [
            "products" => $products->getProducts(),
            "shoppingCartProducts" => $shoppingCartProducts,
            "categories" => $categories,
            "brands"     => $brands,
            "totalPrice" => $totalPrice
        ]);
    }

}