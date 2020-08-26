<?php

namespace App\Infrastructure\Test\Adapter\Repository\Doctrine;

use MChabour\Domain\Security\Gateway\UserGatewayInterface;
use MChabour\Domain\Security\Model\User;
use Ramsey\Uuid\Uuid;

/**
 * Class UserRepository
 * @package App\Infrastructure\Test\Adapter\Repository
 */
class UserRepository implements UserGatewayInterface
{
    /**
     * @inheritDoc
     */
    public function isEmailUnique(?string $email): bool
    {
        return !in_array($email, ["used@email.com"]);
    }


    public function getUserByMail(string $email): ?User
    {
        if ($email !== "used@email.com") {
            return null;
        }

        return new User(Uuid::uuid4(), 'mourad', 'chabour', 'used@mail.com', password_hash("password", PASSWORD_ARGON2I));
    }
}
