<?php

namespace App\UserInterface\Controller;

use App\UserInterface\ViewModel\LoginViewModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    /**
     * @Route("/login", name="app.login", methods={"GET", "POST"})
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function __invoke(AuthenticationUtils $authenticationUtils)
    {
        return $this->render("ui/sign-in.html.twig", [
            "vm" => LoginViewModel::fromAuthenticationUtils($authenticationUtils)
        ]);
    }
}
