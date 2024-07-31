<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use TroskiShop\Application\DTOs\User\RegisterUserFormDto;
use TroskiShop\Application\Exceptions\EmailIsAlreadyInUse;
use TroskiShop\Application\Exceptions\PasswordNonEqualsThanPasswordConfirm;
use TroskiShop\Application\Services\User\RegisterNewUser;

class RegistrationController extends AbstractController
{
    #[Route(path: '/register', name: 'register', methods: ['POST'])]
    public function register(Request $request, RegisterNewUser $registerNewUser): RedirectResponse
    {
        try {
            $registerUserFormDto = $this->createRegisterUserFormDtoFromRequest($request);
            $registerNewUser->execute($registerUserFormDto);
            $this->addFlash('success', 'Registro exitoso, por favor inicie sesión');
        } catch (EmailIsAlreadyInUse $e){
            $this->addFlash('error','El email ya está en uso.');
        } catch (PasswordNonEqualsThanPasswordConfirm $confirm){
            $this->addFlash('error', 'La contraseña y la confirmación de contraseña no coinciden');
        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
        }
        return $this->redirectToRoute('app_login');
    }

    private function createRegisterUserFormDtoFromRequest(Request $request): RegisterUserFormDto
    {
        return new RegisterUserFormDto(
            $request->request->get('nif'),
            $request->request->get('firstName'),
            $request->request->get('lastName'),
            $request->request->get('telephone'),
            $request->request->get('email'),
            $request->request->get('password'),
            $request->request->get('confirmPassword')
        );
    }
}