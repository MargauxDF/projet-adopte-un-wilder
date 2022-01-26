<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/inscription", name="register")
     */
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $encoder
    ): Response {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->issubmitted() && $form->isValid()) {
            $password = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
