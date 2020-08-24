<?php

namespace MChabour\Domain\Security\Presenter;

use MChabour\Domain\Security\Response\RegistrationResponse;

/**
 * Interface RegistrationPresenterInterface
 * @package MChabour\Domain\Security\Presenter
 */
interface RegistrationPresenterInterface
{

    /**
     * @param RegistrationResponse $response
     */
    public function present(RegistrationResponse $response): void;
}
