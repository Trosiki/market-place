<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\Exceptions\ProductNotFoundException;
use TroskiShop\Application\Services\ShoppingCart\DeleteProductOfShoppingCartFromUri;
use TroskiShop\Domain\Model\User;

class RemoveProductOfCartController extends AbstractController
{

    #[Route('/cart/remove', name: 'remove_of_shoppingcart', methods: ['POST'])]
    public function removeProduct(Request $request, DeleteProductOfShoppingCartFromUri $deleteProductOfShoppingCartFromUri)
    {
        /** @var ?User $user */
        $user = $this->getUser()?->getAppUser();
        if(!$user instanceof User) {
            $this->addFlash('error', 'Es necesario iniciar sesión para realizar esta acción');
            return $this->redirectToRoute('app_login');
        }

        try {
            if($user->getActiveShoppingCart() === false) {
                $this->addFlash('error', 'Actualmente no tiene ningún carrito activo');
                $this->redirectToRoute('homepage');
            }

            $deleteProductOfShoppingCartFromUri->execute($user->getActiveShoppingCart(), $request->request->get('uri'));

        } catch (ProductNotFoundException $e) {
            $this->addFlash('error', 'No se pudo eliminar el producto indicado');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Se ha producido un error inesperado. ' . $e->getMessage());
        }

        return $this->redirectToRoute('cart');
    }
}