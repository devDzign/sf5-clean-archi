<?php

namespace MChabour\Domain\Security\Request;

use Assert\AssertionFailedException;
use MChabour\Domain\Security\Assertion\Assertion;
use MChabour\Domain\Security\Gateway\UserGatewayInterface;

/**
 * Class RegistrationRequest
 * @package MChabour\Domain\Security\Request
 */

class RegistrationRequest
{
    /**
     * @var string|null
     */
    private ?string $firstName;
    /**
     * @var string|null
     */
    private ?string $lastName;
    /**
     * @var string|null
     */
    private ?string $companyName;
    /**
     * @var string|null
     */
    private ?string $email;
    /**
     * @var string|null
     */
    private ?string $plainPassword;

    /**
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $companyName
     * @param string|null $email
     * @param string|null $plainPassword
     *
     * @return static
     */
    public static function create(
        ?string $firstName,
        ?string $lastName,
        ?string $companyName,
        ?string $email,
        ?string $plainPassword
    ): self {
        return new self($firstName, $lastName, $companyName, $email, $plainPassword);
    }

    /**
     * RegistrationRequest constructor.
     *
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $companyName
     * @param string|null $email
     * @param string|null $plainPassword
     */
    public function __construct(
        ?string $firstName,
        ?string $lastName,
        ?string $companyName,
        ?string $email,
        ?string $plainPassword
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->companyName = $companyName;
        $this->email = $email;
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }


    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param UserGatewayInterface $userGateway
     *
     * @throws AssertionFailedException
     */
    public function validate(UserGatewayInterface $userGateway): void
    {
        Assertion::notBlank($this->firstName);
        Assertion::notBlank($this->lastName);
        Assertion::notBlank($this->companyName);
        Assertion::notBlank($this->email);
        Assertion::email($this->email);
        Assertion::nonUniqueEmail($this->email, $userGateway);
        Assertion::notBlank($this->plainPassword);
        Assertion::minLength($this->plainPassword, 8);
    }
}
