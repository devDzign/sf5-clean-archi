<?php


namespace App\UserInterface\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeathController extends AbstractController
{

    /**
     * @Route("/", name="heath", methods={"GET"})
     * @return Response
     */
    public function __invoke(  )
    {
        return $this->render('heath/index.html.twig');
    }
}