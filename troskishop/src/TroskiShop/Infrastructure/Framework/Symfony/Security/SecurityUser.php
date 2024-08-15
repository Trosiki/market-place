<?php

namespace TroskiShop\Infrastructure\Framework\Symfony\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use TroskiShop\Domain\Model\User;

class SecurityUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    private User $appUser;
    private array $roles;

    public function __construct(User $user, array $roles = [])
    {
        $this->appUser = $user;
        $this->roles = (empty($roles)) ? $this->appUser->getRoles() : $roles;
    }

    public function getAppUser(): User
    {
        return $this->appUser;
    }

    public function setAppUser(User $appUser): void
    {
        $this->appUser = $appUser;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = self::ROLE_USER;
        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->appUser->getEmail();
    }

    public function getPassword(): ?string
    {
        return $this->appUser->getPassword();
    }

}