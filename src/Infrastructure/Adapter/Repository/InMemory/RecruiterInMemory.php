<?php

namespace App\Infrastructure\Adapter\Repository\InMemory;

use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Model\User;

class RecruiterInMemory implements RecruiterGatewayInterface
{

    public function register(User $user): void
    {
        // TODO: Implement register() method.
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function isEmailUnique(string $email): bool
    {
        return 'used@mail.fr' !== $email;
    }

    public function getUserByMail(string $email): ?User
    {
        return  new User();
    }
}
