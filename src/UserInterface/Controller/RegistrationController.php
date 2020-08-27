<?php

namespace App\UserInterface\Controller;

use App\UserInterface\DataTransferObject\RegistrationRecruiterDTO;
use App\UserInterface\Form\RegistrationRecruiterType;
use App\UserInterface\Presenter\RegistrationPresenter;
use MChabour\Domain\Security\Request\RegistrationRequest;
use MChabour\Domain\Security\UseCase\Registration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/registration", name="app.registration", methods={"GET", "POST"})
     * @param Request               $request
     * @param Registration          $registration
     * @param RegistrationPresenter $presenter
     *
     * @return Response
     */
    public function __invoke(Request $request, Registration $registration, RegistrationPresenter $presenter)
    {
        $form =  $this->createForm(RegistrationRecruiterType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var RegistrationRecruiterDTO $data */
            $data = $form->getData();

            $registrationRequest  = RegistrationRequest::create(
                $data->getLastName(),
                $data->getFirstName(),
                $data->getCompanyName(),
                $data->getEmail(),
                $data->getPlainPassword()
            );

            $registration->execute($registrationRequest, $presenter);

            return  $this->redirectToRoute('home');
        }

        return $this->render("ui/registration.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
