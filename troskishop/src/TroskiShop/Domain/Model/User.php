<?php
namespace TroskiShop\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use TroskiShop\Application\DTOs\User\RegisterUserFormDto;
use TroskiShop\Infrastructure\Framework\Symfony\Security\SecurityUser;

class User
{
    private int $id;
    private ?string $nif;
    private ?string $name;
    private ?string $surname;
    private ?string $email;
    private ?string $password;
    private ?string $telephone;
    private array $roles;
    private ?Collection $shoppingCarts;

    public function __construct(?string $nif = null, ?string $name = null, ?string $surname = null, ?string $telephone = null, ?string $email = null, ?string $password = null, array $roles = [SecurityUser::ROLE_USER] )
    {
        $this->nif = $nif;
        $this->name = $name;
        $this->surname = $surname;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
        $this->shoppingCarts = new ArrayCollection();
    }

    public static function createFromRegisterUserForm(RegisterUserFormDto $registerUserFormDto): User
    {
        return new self(
            $registerUserFormDto->getNif(),
            $registerUserFormDto->getFirstName(),
            $registerUserFormDto->getLastName(),
            $registerUserFormDto->getTelephone(),
            $registerUserFormDto->getEmail()
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNif(): string
    {
        return $this->nif;
    }

    public function setNif(string $nif): void
    {
        $this->nif = $nif;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getShoppingCarts(): Collection
    {
        return $this->shoppingCarts;
    }

    public function setShoppingCarts(Collection $shoppingCarts): void
    {
        $this->shoppingCarts = $shoppingCarts;
    }

    public function getActiveShoppingCart(): ?ShoppingCart
    {
        return $this->getShoppingCarts()->filter(function (ShoppingCart $shoppingCart) {
            return $shoppingCart->isActive();
        })->first();
    }

}