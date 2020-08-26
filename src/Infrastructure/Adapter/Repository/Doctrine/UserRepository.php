<?php

namespace App\Infrastructure\Adapter\Repository\Doctrine;

use App\Infrastructure\Doctrine\Entity\Recruiter;
use App\Infrastructure\Doctrine\Entity\User as UserDoctrine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MChabour\Domain\Security\Gateway\UserGatewayInterface;
use MChabour\Domain\Security\Model\Recruiter as RecruiterModel;
use MChabour\Domain\Security\Model\User;

/**
 * @method UserDoctrine|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserDoctrine|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserDoctrine[] findAll()
 * @method UserDoctrine[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * Class UserRepository
 * @package App\Infrastructure\Adapter\Repository\Doctrine
 */
class UserRepository extends ServiceEntityRepository implements UserGatewayInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDoctrine::class);
    }

    /**
     * @param string|null $email
     *
     * @return bool
     */
    public function isEmailUnique(?string $email): bool
    {
        return $this->count(["email" => $email]) === 0;
    }

    /**
     * @param string $email
     *
     * @return User|null
     */
    public function getUserByMail(string $email): ?User
    {
        $doctrineUser =  $this->findOneByEmail($email);

        if (!$doctrineUser) {
            return null;
        }

        /** @var Recruiter $doctrineUser */
        return new RecruiterModel(
            $doctrineUser->getId(),
            $doctrineUser->getFirstName(),
            $doctrineUser->getLastName(),
            $doctrineUser->getEmail(),
            $doctrineUser->getCompanyName(),
            $doctrineUser->getPassword(),
        );
    }
}
