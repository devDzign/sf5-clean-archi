<?php

namespace App\Infrastructure\Security\Provider;

use App\Infrastructure\Doctrine\Entity\User;
use MChabour\Domain\Security\Gateway\UserGatewayInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @var UserGatewayInterface
     */
    private UserGatewayInterface $userGateway;

    /**
     * UserProvider constructor.
     *
     * @param UserGatewayInterface $userGateway
     */
    public function __construct(UserGatewayInterface $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function loadUserByUsername(string $email)
    {
        return $this->getUserByUsername($email);
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->getUserByUsername($user->getUsername());
    }

    public function supportsClass(string $class)
    {
        return User::class === $class;
    }


    /**
     * @param string $email
     *
     * @return User
     */
    private function getUserByUsername(string $email): User
    {
        $userModel = $this->userGateway->getUserByMail($email);
        if ($userModel === null) {
            throw new UsernameNotFoundException();
        }

        $userDoctrine = new User();

        return $userDoctrine
            ->setId($userModel->getId())
            ->setFirstName($userModel->getFirstName())
            ->setLastName($userModel->getLastName())
            ->setEmail($userModel->getEmail())
            ->setPassword($userModel->getPassword());
    }
}
