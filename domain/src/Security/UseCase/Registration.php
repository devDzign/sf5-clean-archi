<?php

namespace MChabour\Domain\Security\UseCase;

use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Model\Recruiter;
use MChabour\Domain\Security\Request\RegistrationRequest;
use MChabour\Domain\Security\Response\RegistrationResponse;
use MChabour\Domain\Security\Presenter\RegistrationPresenterInterface;

/**
 * Class Registration
 * @package MChabour\Domain\Security\UseCase
 */
class Registration
{

    /**
     * @var RecruiterGatewayInterface
     */
    private RecruiterGatewayInterface $recruiterGateway;

    public function __construct(RecruiterGatewayInterface $recruiterGateway)
    {
        $this->recruiterGateway = $recruiterGateway;
    }

    /**
     * @param RegistrationRequest            $request
     * @param RegistrationPresenterInterface $presenter
     */
    public function execute(RegistrationRequest $request, RegistrationPresenterInterface $presenter)
    {
        $request->validate($this->recruiterGateway);
        $user = Recruiter::fromRegister($request);
        $this->recruiterGateway->register($user);
        $presenter->present(new RegistrationResponse($user->getEmail()));
    }
}
