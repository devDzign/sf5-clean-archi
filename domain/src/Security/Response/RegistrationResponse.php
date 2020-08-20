<?php

namespace MChabour\Domain\Security\Response;

/**
 * Class RegistrationResponse
 * @package MChabour\Domain\Security\Response
 */
class RegistrationResponse
{
    /**
     * @var string
     */
    private string $email;

    /**
     * RegistrationResponse constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
