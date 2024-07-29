<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use TroskiShop\Application\DTOs\User\RegisterUserFormDto;
use TroskiShop\Application\Services\User\RegisterNewUser;

class SecurityController extends AbstractController
{

    #[Route(path: '/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route(path: '/register', name: 'register', methods: ['POST'])]
    public function register(Request $request, RegisterNewUser $registerNewUser): RedirectResponse
    {
        try {
            $registerUserFormDto = $this->createRegisterUserFormDtoFromRequest($request);
            $registerNewUser->execute($registerUserFormDto);
            $this->addFlash('success', 'Registro exitoso, por favor inicie sesión');
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