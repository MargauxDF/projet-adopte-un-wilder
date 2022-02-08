<?php

namespace App\Controller;

use App\Entity\LabelCv;
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
         $wildersPhp = $userRepository->findBy(['labelCv' => 1]);
         $wildersData = $userRepository->findBy(['labelCv' => 2]);
         $wildersJs = $userRepository->findBy(['labelCv' => 3]);
        $wildersJava = $userRepository->findBy(['labelCv' => 4]);

        return $this->render('wilder/index.html.twig', [
            'wilders' => $userRepository->findAll(),
            'wildersPhp' => $wildersPhp,
            'wildersData' => $wildersData,
            'wildersJs' => $wildersJs,
            'wildersJava' => $wildersJava,
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
