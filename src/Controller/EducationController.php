<?php

namespace App\Controller;

use App\Entity\Education;
use App\Form\EducationType;
use App\Repository\EducationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/account", name = "")]
 */
class EducationController extends AbstractController
{
    /**
     * @Route("/formations", name = "education_index")]
     */
    public function index(EducationRepository $educationRepository): Response
    {
        return $this->render('education/index.html.twig', [
            'educations' => $this->getUser()->getEducations(),
        ]);
    }

    /**
     * @Route("/formation/add", name="education_add", methods={"GET", "POST"})
     */
    public function addEducation(Request $request, EntityManagerInterface $entityManager, EducationRepository $educationRepository): Response
    {
        $education  = new Education();

        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);
        $education->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($education);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre formation a été ajoutée avec succès !'
            );

            return $this->redirectToRoute('education_index');
        }

        return $this->render('education/add.html.twig', [
           'form' => $form->createView(),
           'educations' => $this->getUser()->getEducations(),
        ]);
    }

    /**
     * @Route("/formation/{id}/edit", name="education_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, Education $education, EducationRepository $educationRepository): Response
    {
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre formation a été mise à jour avec succès !'
            );

            return $this->redirectToRoute('education_index');
        }

        return $this->render('education/edit.html.twig', [
            'education' => $education,
            'form' => $form->createView(),
            'educations' => $this->getUser()->getEducations(),
        ]);
    }

    /**
     * @Route("/formation/{id}", name="education_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Education $education, EntityManagerInterface $entityManager): Response
    {
            $entityManager->remove($education);
            $entityManager->flush();

            $this->addFlash(
                'delete-success',
                'Votre formation a été supprimée avec succès !'
            );


        return $this->redirectToRoute('education_index');
    }
}
