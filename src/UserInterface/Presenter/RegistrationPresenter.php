<?php

namespace App\UserInterface\Presenter;

use App\UserInterface\ViewModel\RegistrationViewModel;
use MChabour\Domain\Security\Gateway\RecruiterGatewayInterface;
use MChabour\Domain\Security\Gateway\UserGatewayInterface;
use MChabour\Domain\Security\Presenter\RegistrationPresenterInterface;
use MChabour\Domain\Security\Response\RegistrationResponse;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class RegistrationPresenter implements RegistrationPresenterInterface
{
    /**
     * @var FlashBagInterface
     */
    private FlashBagInterface $flashBag;

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
     * @param FlashBagInterface    $flashBag
     * @param RecruiterGatewayInterface $userGateway
     */
    public function __construct(FlashBagInterface $flashBag, RecruiterGatewayInterface $userGateway)
    {
        $this->flashBag = $flashBag;


        $this->userGateway = $userGateway;
    }

    public function present(RegistrationResponse $response): void
    {
        $this->viewModel = new RegistrationViewModel($this->userGateway->getUserByMail($response->getEmail()));

        $this->flashBag->add(
            "success",
            "Bienvenue sur Code Challenge ! Votre inscription a été effectuée avec succès !"
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
