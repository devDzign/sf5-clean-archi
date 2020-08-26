<?php

namespace MChabour\Domain\Security\UseCase;

use MChabour\Domain\Security\Gateway\UserGatewayInterface;
use MChabour\Domain\Security\Request\LoginRequest;
use MChabour\Domain\Security\Response\LoginResponse;
use MChabour\Domain\Security\Presenter\LoginPresenterInterface;

/**
 * Class Login
 * @package MChabour\Domain\Security\UseCase
 */
class Login
{
    /**
     * @var UserGatewayInterface
     */
    private UserGatewayInterface $userGateway;

    /**
     * Login constructor.
     *
     * @param UserGatewayInterface $userGateway
     */
    public function __construct(UserGatewayInterface $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    /**
     * @param LoginRequest $request
     * @param LoginPresenterInterface $presenter
     */
    public function execute(LoginRequest $request, LoginPresenterInterface $presenter)
    {
        $request->validate();

        $user = $this->userGateway->getUserByMail($request->getEmail());


        if ($user) {
            $passwordValid = password_verify($request->getPassword(), $user->getPassword());
            dd($passwordValid);
        }

        $presenter->present(new LoginResponse($user, $passwordValid ?? false));
    }
}
