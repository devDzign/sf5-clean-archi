<?php

namespace App\Infrastructure\Test\Adapter\Repository\Doctrine;

use MChabour\CodeChallenge\Domain\Security\Entity\Participant;
use MChabour\CodeChallenge\Domain\Security\Gateway\ParticipantGateway;
use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Model\Recruiter;
use MChabour\Domain\Security\Model\User;
use Ramsey\Uuid\Uuid;

/**
 * Class UserRepository
 * @package App\Infrastructure\Test\Adapter\Repository
 */
class RecruiterRepository implements RecruiterGatewayInterface
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

        return new Recruiter(Uuid::uuid4(), 'mourad', 'chabour', 'Company co', 'used@mail.com', 'password');
    }

    public function register(Recruiter $recruiter): void
    {
        // TODO: Implement register() method.
    }
}
