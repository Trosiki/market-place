<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\DTOs\ShoppingCart\ProductToAddToShoppingCart;
use TroskiShop\Application\Exceptions\CannotAddMoreProductInShoppingCart;
use TroskiShop\Application\Services\ShoppingCart\AddProductInShoppingCart;
use TroskiShop\Domain\Model\ShoppingCart;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\ShoppingCartRepositoryInterface;

class AddToShoppingCartController extends AbstractController
{
    #[Route('/cart/add', name: 'add_to_shoppingcart', methods: ["POST"])]
    public function addToShoppingCart(Request $request, AddProductInShoppingCart $addProductInShoppingCart, ShoppingCartRepositoryInterface $shoppingCartRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser()?->getAppUser();
        if(empty($user)) {
            $this->addFlash('error','Para añadir un producto al carrito debe iniciar sesión.');
            return $this->redirectToRoute('app_login',[]);
        }

        $shoppingCartRepository->beginTransaction();
        try {
            $productToAddToShoppingCart = $this->generateProductToAddToShoppingCartFromRequest($request, $user);
            $addProductInShoppingCart->execute($productToAddToShoppingCart);
            $shoppingCartRepository->commit();
        } catch (CannotAddMoreProductInShoppingCart $e) {
            $shoppingCartRepository->rollbackTransaction();
            $this->addFlash('error','El carrito no puede superar el número total de '. ShoppingCart::MAX_PRODUCTS_IN_SHOPPINGCART . ' está tratando de obtener ' . $e->getNewTotal() .' productos en una única compra.');
            return $this->redirectToRoute('homepage');
        } catch (\Exception $e) {
            $shoppingCartRepository->rollbackTransaction();
            $this->addFlash('error','Se ha producido un error inesperado, vuelva a intentarlo más adelante. ' .$e->getMessage());
            return $this->redirectToRoute('homepage');
        }

        $routeToRedirect = $request->headers->get('referer') ?? $this->generateUrl('homepage');
        return $this->redirect($routeToRedirect);
    }

    private function generateProductToAddToShoppingCartFromRequest(Request $request, User $user): ProductToAddToShoppingCart
    {
        return new ProductToAddToShoppingCart(
          $user,
          $request->request->get('uri'),
          $request->request->get('quantity'),
          $user->getActiveShoppingCart()
        );
    }
}