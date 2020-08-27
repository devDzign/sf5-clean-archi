<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Infrastructure\Doctrine\Entity\JobSeeker;
use App\Infrastructure\Doctrine\Entity\Recruiter;
use App\Infrastructure\Doctrine\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $recruiter = new Recruiter();
        $jobSeeker = new User();

        $recruiter->setId(Uuid::uuid4())
            ->setFirstName('Mourad')
            ->setLastName('Chabour')
            ->setEmail('used_recruiter@mail.com')
            ->setPassword(password_hash("password", PASSWORD_ARGON2I))
            ->setCompanyName('Company co')
            ;

        $jobSeeker->setId(Uuid::uuid4())
            ->setFirstName('Mourad')
            ->setLastName('Chabour')
            ->setEmail('used_jobseeker@mail.com')
            ->setPassword(password_hash("password", PASSWORD_ARGON2I))
        ;

        $manager->persist($recruiter);
        $manager->persist($jobSeeker);
        $manager->flush();
    }
}
