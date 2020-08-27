<?php

namespace App\Infrastructure\Adapter\Repository\Doctrine;

use App\Infrastructure\Doctrine\Entity\Recruiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Model\Recruiter as RecruiterModel;
use MChabour\Domain\Security\Model\User;

/**
 * @method Recruiter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recruiter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recruiter[] findAll()
 * @method Recruiter[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * Class RecruiterRepository
 * @package App\Infrastructure\Adapter\Repository\Doctrine
 */
class RecruiterRepository extends ServiceEntityRepository implements RecruiterGatewayInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recruiter::class);
    }

    /**
     * @param RecruiterModel $recruiter
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function register(RecruiterModel $recruiter): void
    {
        $recruiterDoctrine = new Recruiter();

        $recruiterDoctrine
            ->setId($recruiter->getId())
            ->setFirstName($recruiter->getFirstName())
            ->setLastName($recruiter->getLastName())
            ->setCompanyName($recruiter->getCompanyName())
            ->setEmail($recruiter->getEmail())
            ->setPassword($recruiter->getPassword());

        $this->save($recruiterDoctrine);
    }

    /**
     * @param Recruiter $recruiter
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function save(Recruiter $recruiter)
    {
        $this->_em->persist($recruiter);
        $this->_em->flush();
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
    public function getUserByMail(string $email): ?RecruiterModel
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
