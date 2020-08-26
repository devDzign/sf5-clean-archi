<?php

namespace MChabour\Domain\Security\Presenter;

use MChabour\Domain\Security\Response\LoginResponse;

/**
 * Interface LoginPresenterInterface
 * @package MChabour\Domain\Security\Presenter
 */
interface LoginPresenterInterface
{
    /**
     * @param LoginResponse $response
     */
    public function present(LoginResponse $response): void;
}
