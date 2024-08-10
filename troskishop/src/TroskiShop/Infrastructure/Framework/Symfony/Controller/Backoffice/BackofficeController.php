<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Controller\Backoffice;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use TroskiShop\Domain\Model\Order;
use TroskiShop\Domain\Model\Product;
use TroskiShop\Domain\Model\User;
use TroskiShop\Infrastructure\Framework\Symfony\Security\SecurityUser;

class BackofficeController extends AbstractDashboardController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {

        return $this->render('backoffice/backoffice.html.twig');
        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    #[Route('/login', name: 'login_backend')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('@EasyAdmin/page/login.html.twig',[
            'error' => $error,
            'last_username' => $lastUsername,
            // the translation_domain to use (define this option only if you are
            // rendering the login template in a regular Symfony controller; when
            // rendering it from an EasyAdmin Dashboard this is automatically set to
            // the same domain as the rest of the Dashboard)
            'translation_domain' => 'admin',

            // by default EasyAdmin displays a black square as its default favicon;
            // use this method to display a custom favicon: the given path is passed
            // "as is" to the Twig asset() function:
            // <link rel="shortcut icon" href="{{ asset('...') }}">
            'favicon_path' => '/favicon-admin.svg',

            // the title visible above the login form (define this option only if you are
            // rendering the login template in a regular Symfony controller; when rendering
            // it from an EasyAdmin Dashboard this is automatically set as the Dashboard title)
            'page_title' => 'TroskiShop Back',

            // the string used to generate the CSRF token. If you don't define
            // this parameter, the login form won't include a CSRF token
            'csrf_token_intention' => 'authenticate',
            // the URL users are redirected to after the login (default: '/admin')
            'target_path' => $this->generateUrl('dashboard'),

            'username_label' => 'Usuario',
            'password_label' => 'Contraseña',
            'sign_in_label' => 'Log in',
            'username_parameter' => '_username',
            'password_parameter' => '_password',
            'forgot_password_enabled' => false,
            'remember_me_enabled' => true,
            'remember_me_parameter' => '_remember_me',
            'remember_me_checked' => true,
            'remember_me_label' => 'Recuérdame',
        ]);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TroskiShop Backoffice');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Product', 'fas fa-shopping-cart', Product::class);
        yield MenuItem::linkToCrud('Order', 'fa fa-dollar', Order::class);
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): \EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu
    {
        /** @var SecurityUser $user */
        return parent::configureUserMenu($user)
            ->setName($user->getAppUser()->getName())
            ->displayUserName(false)
            ->setAvatarUrl('https://...')
            ->displayUserAvatar(false)
            ->setGravatarEmail($user->getAppUser()->getEmail())
            ->addMenuItems([
                MenuItem::linkToRoute('Mi perfil', 'fa fa-id-card', '...', ['...' => '...']),
                MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
    }
}
