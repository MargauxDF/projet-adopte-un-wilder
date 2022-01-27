<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EducationController extends AbstractController
{
    #[Route('/education', name: 'education')]
    public function index(): Response
    {
        return $this->render('education/index.html.twig', [
            'controller_name' => 'EducationController',
        ]);
    }
}
