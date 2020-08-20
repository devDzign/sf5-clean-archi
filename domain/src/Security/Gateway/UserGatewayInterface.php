<?php

namespace MChabour\Domain\Security\Gateway;

use MChabour\Domain\Security\Model\User;

/**
 * Interface UserGatewayInterface
 * @package MChabour\Domain\Security\Gateway
 */
interface UserGatewayInterface
{
    /**
     * @param string $email
     *
     * @return bool
     */
    public function isEmailUnique(string $email): bool;

    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByMail(string $email): ?User;
}
