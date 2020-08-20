<?php

namespace App\UserInterface\DataTransferObject;

/**
 * Class RegistrationDTO
 * @package App\UserInterface\DataTransferObject
 */
class RegistrationRecruiterDTO extends RegistrationDTO
{

    /**
     * @var string|null
     */
    private ?string $companyName = null;

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
     * @return RegistrationRecruiterDTO
     */
    public function setCompanyName(?string $companyName): RegistrationRecruiterDTO
    {
        $this->companyName = $companyName;

        return $this;
    }
}
