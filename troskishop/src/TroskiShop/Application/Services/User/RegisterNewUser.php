<?php

namespace TroskiShop\Application\Services\User;

use TroskiShop\Application\DTOs\User\RegisterUserFormDto;
use TroskiShop\Application\Exceptions\EmailIsAlreadyInUse;
use TroskiShop\Application\Exceptions\PasswordNonEqualsThanPasswordConfirm;
use TroskiShop\Application\Security\HasherPasswordInterface;
use TroskiShop\Domain\Model\User;
use TroskiShop\Domain\Repository\UserRepositoryInterface;
use TroskiShop\Infrastructure\Framework\Symfony\Security\SecurityUser;

class RegisterNewUser
{
    private UserRepositoryInterface $userRepository;
    private HasherPasswordInterface $hasherPassword;

    public function __construct(UserRepositoryInterface $userRepository, HasherPasswordInterface $hasherPassword)
    {
        $this->userRepository = $userRepository;
        $this->hasherPassword = $hasherPassword;
    }

    public function execute(RegisterUserFormDto $registerUserFormDto)
    {
        $this->validateRegisterUserForm($registerUserFormDto);
        $user = $this->createUserWithPasswordHashed($registerUserFormDto);
        $this->userRepository->save($user, true);
    }

    private function validateRegisterUserForm(RegisterUserFormDto $registerUserFormDto)
    {
        $this->checkPasswordConfirmation($registerUserFormDto->getPassword(), $registerUserFormDto->getConfirmPassword());
        $this->checkEmailIsNotInUse($registerUserFormDto->getEmail());
    }

    /**
     * @param $password
     * @param $passwordConfirm
     * @return bool
     * @throws PasswordNonEqualsThanPasswordConfirm
     */
    private function checkPasswordConfirmation($password, $passwordConfirm) :bool
    {
        if ($password !== $passwordConfirm) {
            throw new PasswordNonEqualsThanPasswordConfirm();
        }

        return true;
    }

    private function checkEmailIsNotInUse($email) :bool
    {
        $user = $this->userRepository->findByEmail($email);

        if(!empty($user)) {
            throw new EmailIsAlreadyInUse($email);
        }

        return empty($user);
    }

    private function createUserWithPasswordHashed(RegisterUserFormDto $registerUserFormDto): User
    {
        $user = User::createFromRegisterUserForm($registerUserFormDto);
        $passwordHashed = $this->hasherPassword->hashPassword(new SecurityUser($user), $registerUserFormDto->getPassword());
        $user->setPassword($passwordHashed);

        return $user;
    }
}