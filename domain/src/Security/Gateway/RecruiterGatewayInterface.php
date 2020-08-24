<?php

namespace MChabour\Domain\Security\Gateway;

use MChabour\Domain\Security\Model\Recruiter;

/**
 * Interface RecruiterGatewayInterface
 * @package MChabour\Domain\Security\Gateway
 */
interface RecruiterGatewayInterface extends UserGatewayInterface
{
    /**
     * @param Recruiter $recruiter
     */
    public function register(Recruiter $recruiter): void;
}
