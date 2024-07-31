<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Domain\Model\Product;
use TroskiShop\Domain\Model\ShoppingCartProduct;

class DetailCartController extends AbstractController
{
    #[Route(path: '/cart', name: 'cart', methods: ['GET'])]
    public function detail(Product $product): Response
    {
        $shoppingCartProducts = [];
        $totalPrice = 0;
        for($i = 0; $i < 3; $i++) {
            $shoppingCartProduct = new ShoppingCartProduct();

            $product = new Product();
            $product->setName("Nombre ejemplo " . $i);
            $product->setCategory("Categoria");
            $product->setDescription("Una descripción algo breve pero a la vez algo larga para ver como queda esta vaina, porque me resulta interesante ver cómo encaja con mucho texto.");
            $product->setImage('image/ejemplo.png');
            $product->setPrice(rand(0,1000));

            $shoppingCartProduct->setProduct($product);
            $shoppingCartProduct->setQuantity(1);
            $shoppingCartProducts[] = $shoppingCartProduct;
            $totalPrice += $product->getPrice();
        }

        return $this->render('/front_pages/cart/detail-cart.html.twig', [
            'shoppingCartProducts' => $shoppingCartProducts,
            'totalPrice' => $totalPrice,
        ]);
    }
}