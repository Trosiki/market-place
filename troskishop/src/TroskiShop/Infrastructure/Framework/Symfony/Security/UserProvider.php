<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\ShoppingCartRepositoryInterface;
use TroskiShop\Domain\Repository\UserRepositoryInterface;

class UserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    private UserRepositoryInterface $userRepository;
    private ShoppingCartRepositoryInterface $shoppingCartRepository;

    public function __construct(UserRepositoryInterface $userRepository, ShoppingCartRepositoryInterface $shoppingCartRepository)
    {
        $this->userRepository = $userRepository;
        $this->shoppingCartRepository = $shoppingCartRepository;
    }

    public function refreshUser(UserInterface $user)
    {
        if(!$user instanceof SecurityUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $user;
    }

    public function supportsClass(string $class)
    {
        return SecurityUser::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        /** @var User $appUser */
        $appUser =  $this->userRepository->findWithActiveShoppingCartByEmail($identifier);
        if(empty($appUser)) {
            throw new UserNotFoundException('User not found.');
        }

        return new SecurityUser($appUser);
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
    }
}