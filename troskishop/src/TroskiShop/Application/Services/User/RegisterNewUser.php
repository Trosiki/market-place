<?php

namespace TroskiShop\Application\Services\User;

use TroskiShop\Application\DTOs\User\RegisterUserFormDto;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\UserRepositoryInterface;

class RegisterNewUser
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RegisterUserFormDto $registerUserFormDto)
    {
        $this->userRepository->save(User::createFromRegisterUserForm($registerUserFormDto));
    }
}