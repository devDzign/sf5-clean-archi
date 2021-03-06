<?php

namespace App\UserInterface\ViewModel;

use MChabour\Domain\Security\Model\User;

class RegistrationViewModel
{
    /**
     * @var User
     */
    private User $user;

    /**
     * RegistrationViewModel constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
