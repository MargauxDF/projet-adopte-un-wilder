<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account", name="account_")
 */
class InfoController extends AbstractController
{
    /**
    * @Route("/infos", name="infos")
    */
    public function index(UserRepository $userRepository): Response
    {
        $infos = $userRepository->findAll();

        return $this->render('info/index.html.twig', [
            'infos' => $infos,
        ]);
    }

    /**
     * @Route("/infos/add", name="infos_add")
     * @IsGranted("ROLE_USER")
     *
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $info = new User();

    }
}
