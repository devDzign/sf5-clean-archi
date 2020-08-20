<?php

namespace MChabour\Domain\Security\Model;

use MChabour\Domain\Security\Request\RegistrationRequest;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User
{

    /**
     * @var UuidInterface
     */
    protected UuidInterface $id;

    /**
     * @var string|null
     */
    protected ?string $firstName;

    /**
     * @var string|null
     */
    protected ?string $lastName;

    /**
     * @var string|null
     */
    protected ?string $email;

    /**
     * @var false|string|null
     */
    protected ?string $password;


    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     */
    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
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
     * @return false|string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param false|string|null $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
