<?php

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Recruiter extends User
{

    /**
     * @var string|null
     * @ORM\Column
     */
    private ?string $companyName;

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
