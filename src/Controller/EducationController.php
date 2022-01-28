<?php

namespace App\Controller;

use App\Entity\Education;
use Composer\DependencyResolver\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account", name = "")]
 */
class EducationController extends AbstractController
{
    /**
     * @Route("/", name = "index")]
     */
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }
}
