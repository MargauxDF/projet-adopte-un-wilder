<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WilderController extends AbstractController
{
    /**
     * @Route("/wilders", name="wilder_index")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('wilder/index.html.twig', [
            'wilders' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/wilders/{slug}", name="wilder_show")
     */
    public function show(string $slug, UserRepository $userRepository): Response
    {
        $wilder = $userRepository->findOneBy(['slug' => $slug]);

        return $this->render('wilder/show.html.twig', [
            'wilder' => $wilder,
        ]);
    }
}
