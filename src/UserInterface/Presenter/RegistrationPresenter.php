<?php

namespace App\UserInterface\Presenter;

use App\UserInterface\ViewModel\RegistrationViewModel;
use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Presenter\RegistrationPresenterInterface;
use MChabour\Domain\Security\Response\RegistrationResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RegistrationPresenter implements RegistrationPresenterInterface
{
    /**
     * @var SessionInterface
     */
    private SessionInterface $session;

    /**
     * @var RegistrationViewModel
     */
    private RegistrationViewModel $viewModel;

    /**
     * @var RecruiterGatewayInterface
     */
    private RecruiterGatewayInterface $userGateway;


    /**
     * RegistrationPresenter constructor.
     *
     * @param SessionInterface    $session
     * @param RecruiterGatewayInterface $userGateway
     */
    public function __construct(SessionInterface $session, RecruiterGatewayInterface $userGateway)
    {
        $this->session = $session;
        $this->userGateway = $userGateway;
    }

    public function present(RegistrationResponse $response): void
    {
        $this->viewModel = new RegistrationViewModel($this->userGateway->getUserByMail($response->getEmail()));

        $this->session->getFlashBag()->add(
            "success",
            "Bienvenue sur mon site ! Votre inscription a été effectuée avec succès !"
        );
    }

    /**
     * @return RegistrationViewModel
     */
    public function getViewModel(): RegistrationViewModel
    {
        return $this->viewModel;
    }
}
