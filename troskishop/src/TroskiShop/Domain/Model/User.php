<?php
namespace TroskiShop\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use TroskiShop\Application\DTOs\User\RegisterUserFormDto;

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
    private ?array $shoppingCarts;

    public function __construct(?string $nif = null, ?string $name = null, ?string $surname = null, ?string $telephone = null, ?string $email = null, ?string $password = null, array $roles = ['ROLE_USER'] )
    {
        $this->nif = $nif;
        $this->name = $name;
        $this->surname = $surname;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
        $this->shoppingCarts = [];
    }

    public static function createFromRegisterUserForm(RegisterUserFormDto $registerUserFormDto): User
    {
        return new self(
            $registerUserFormDto->getNif(),
            $registerUserFormDto->getFirstName(),
            $registerUserFormDto->getLastName(),
            $registerUserFormDto->getTelephone(),
            $registerUserFormDto->getEmail(),
            $registerUserFormDto->getPassword(),
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

    public function getRoles(): string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): void
    {
        $this->roles = $roles;
    }

    public function getShoppingCarts(): array
    {
        return $this->shoppingCarts;
    }

    public function setShoppingCarts(array $shoppingCarts): void
    {
        $this->shoppingCarts = $shoppingCarts;
    }

}