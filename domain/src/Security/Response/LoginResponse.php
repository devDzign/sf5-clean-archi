<?php

namespace MChabour\Domain\Security\Response;

use MChabour\Domain\Security\Model\User;

/**
 * Class LoginResponse
 * @package MChabour\Domain\Security\Response
 */
class LoginResponse
{
    /**
     * @var User|null
     */
    private ?User $user;
    private bool $passwordValid;


    /**
     * LoginResponse constructor.
     *
     * @param User|null $user
     * @param bool      $passwordValid
     */
    public function __construct(?User $user, bool $passwordValid)
    {
        $this->user = $user;
        $this->passwordValid = $passwordValid;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function isPasswordValid(): bool
    {
        return $this->passwordValid;
    }
}
