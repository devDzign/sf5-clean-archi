<?php

namespace MChabour\Domain\Security\Model;

use MChabour\Domain\Security\Request\RegistrationRequest;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Recruiter extends User
{
    /**
     * @var string|null
     */
    private ?string $companyName;

    /**
     * @param RegistrationRequest $request
     *
     * @return static
     */
    public static function fromRegister(RegistrationRequest $request): self
    {
        return new self(
            Uuid::uuid4(),
            $request->getFirstName(),
            $request->getLastName(),
            $request->getCompanyName(),
            $request->getEmail(),
            password_hash($request->getPlainPassword(), PASSWORD_ARGON2I)
        );
    }


    /**
     * Participant constructor.
     *
     * @param UuidInterface $id
     * @param string|null   $firstName
     * @param string|null   $lastName
     * @param string|null   $companyName
     * @param string|null   $email
     * @param string|null   $password
     */
    public function __construct(
        UuidInterface $id,
        ?string $firstName,
        ?string $lastName,
        ?string $companyName,
        ?string $email,
        ?string $password
    ) {

        parent::__construct($id,$firstName, $lastName, $email, $password);
        $this->companyName = $companyName;
    }

    /**
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @param string|null $companyName
     *
     * @return Recruiter
     */
    public function setCompanyName(?string $companyName): Recruiter
    {
        $this->companyName = $companyName;

        return $this;
    }
}
