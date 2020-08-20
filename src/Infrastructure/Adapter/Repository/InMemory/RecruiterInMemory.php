<?php

namespace App\Infrastructure\Adapter\Repository\InMemory;

use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Model\Recruiter;
use MChabour\Domain\Security\Model\User;
use Ramsey\Uuid\Uuid;

class RecruiterInMemory implements RecruiterGatewayInterface
{
    /**
     * @inheritDoc
     */
    public function isEmailUnique(?string $email): bool
    {
        return $email != "used@email.com";
    }


    public function getUserByMail(string $email): ?User
    {
        if ($email === "used@email.com") {
            return null;
        }

        return new Recruiter(Uuid::uuid4(), 'mourad', 'chabour', 'Company co', 'mchabour@mail.com', 'password');
    }


    public function register(Recruiter $recruiter): void
    {
        // TODO: Implement register() method.
    }
}
