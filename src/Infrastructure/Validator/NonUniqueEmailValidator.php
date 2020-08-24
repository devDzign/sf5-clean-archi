<?php

namespace App\Infrastructure\Validator;

use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NonUniqueEmailValidator extends ConstraintValidator
{
    /**
     * @var RecruiterGatewayInterface
     */
    private RecruiterGatewayInterface $recruiterGateway;

    /**
     * NonUniqueEmailValidator constructor.
     *
     * @param RecruiterGatewayInterface $recruiterGateway
     */
    public function __construct(RecruiterGatewayInterface $recruiterGateway)
    {
        $this->recruiterGateway = $recruiterGateway;
    }

    public function validate($value, Constraint $constraint)
    {

        if (!$this->recruiterGateway->isEmailUnique($value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
