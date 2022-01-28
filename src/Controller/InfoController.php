<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InfoType;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account", name="")
 */
class InfoController extends AbstractController
{
    /**
    * @Route("/", name="index")
    */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('account/index.html.twig');
    }

    /**
     * @Route("/infos", name="infos_index", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     *
     */
    public function addInfo(Request $request, EntityManagerInterface $entityManager): Response
    {
        $info = new User();

        $form = $this->createForm(InfoType::class, $info);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($info);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Vos infos ont été mises à jour avec succès !"
            );

            return $this->redirectToRoute('account');
        }
        return $this->render('info/index.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/infos/{id}/edit", name="info_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, User $info, UserRepository $infoRepository): Response
    {
        $form = $this->createForm(InfoType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vos infos ont été mises à jour avec succès !'
            );

            return $this->redirectToRoute('infos_index');
        }

        return $this->render('info/index.html.twig', [
            'info' => $info,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/infos/{id}", name="infos_delete")
     *
     */
    public function delete(User $info, EntityManagerInterface $entityManager): Response
    {
            $entityManager->remove($info);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "{$info->getFirstname()}, Votre compte a ont été supprimé avec succès !"
            );

        return $this->redirectToRoute("infos_index");
    }
}
