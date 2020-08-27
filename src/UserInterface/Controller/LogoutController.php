<?php

namespace App\UserInterface\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LogoutController
 * @package App\UserInterface\Controller
 */
class LogoutController
{

    /**
     * @Route("/login", name="app.logout", methods={"GET", "POST"})
     */
    public function __invoke(): void
    {
    }
}
