<?php

namespace App\Infrastructure\Adapter\Repository\Doctrine;

use App\Infrastructure\Entity\JobSeeker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MChabour\Domain\Security\Gateway\JobSeekerGatewayInterface;

/**
 * @method JobSeeker|null find($id, $lockMode =  null, $lockVersion =  null)
 * @method JobSeeker|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobSeeker[] findAll()
 * @method JobSeeker[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * Class JobSeekerRepository
 * @package App\Infrastructure\Adapter\Repository\Doctrine
 */
class JobSeekerRepository extends ServiceEntityRepository implements JobSeekerGatewayInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobSeeker::class);
    }
}
