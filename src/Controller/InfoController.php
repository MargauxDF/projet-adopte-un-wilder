<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InfoType;
use App\Service\FileUploader;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     */
    public function addInfo(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $user = new User();

        $form = $this->createForm(InfoType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $pictureFile */
            $pictureFile = $form->get('picture')->getData();
            if ($pictureFile) {
                $pictureFileName = $fileUploader->upload($pictureFile);
                $user->setPictureFilename($pictureFileName);
            }

            $entityManager->persist($user);
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
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager,
        User $user,
        FileUploader $fileUploader
    ): Response {

        $form = $this->createForm(InfoType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $pictureFile */
            $pictureFile = $form->get('picture')->getData();
            if ($pictureFile) {
                $pictureFileName = $fileUploader->upload($pictureFile);
                $user->setPictureFilename($pictureFileName);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vos infos ont été mises à jour avec succès !'
            );

            return $this->redirectToRoute('infos_index');
        }

        return $this->render('info/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/infos/{id}", name="infos_delete")
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $this->get('security.token_storage')->setToken(null);
        $request->getSession()->invalidate();

        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash(
            'success',
            "{$user->getFirstname()}, Votre compte a été supprimé avec succès, mais nous serions ravis de vous retrouver parmi nous !"
        );

        return $this->redirectToRoute("register");
    }
}
