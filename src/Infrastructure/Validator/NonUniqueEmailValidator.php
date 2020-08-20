<?php

namespace App\Infrastructure\Validator;

use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Gateway\UserGatewayInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NonUniqueEmailValidator extends ConstraintValidator
{
    /**
     * @var RecruiterGatewayInterface
     */
    private RecruiterGatewayInterface $userGateway;

    /**
     * NonUniqueEmailValidator constructor.
     *
     * @param RecruiterGatewayInterface $userGateway
     */
    public function __construct(RecruiterGatewayInterface $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$this->userGateway->isEmailUnique($value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
