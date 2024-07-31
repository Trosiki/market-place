<?php

namespace TroskiShop\Application\DTOs\User;

class RegisterUserFormDto
{
    private string $nif;
    private string $firstName;
    private string $lastName;
    private string $telephone;
    private string $email;
    private string $password;
    private string $confirmPassword;

    public function __construct(string $nif, string $firstName, string $lastName, string $telephone, string $email, string $password, string $confirmPassword)
    {
        $this->nif = $nif;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function getNif(): string
    {
        return $this->nif;
    }

    public function setNif($nif): void
    {
        $this->nif = $nif;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword($confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }

}