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
     * @Route("/", name = "index")]
     */
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    /**
     * @Route("/formations", name="education_index", methods={"GET", "POST"})
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
                'Votre formation a été ajouté !'
            );

            return $this->redirectToRoute('education_index');
        }

        return $this->render('education/index.html.twig', [
           'form' => $form->createView(),
           'educations' => $this->getUser()->getEducations(),
        ]);
    }

    /**
     * @Route("/formations/{id}/edit", name="education_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, Education $education, EducationRepository $educationRepository): Response
    {
        $form = $this->createForm(EducationType::class, $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre formation a été mise à jour !'
            );

            return $this->redirectToRoute('education_index');
        }

        return $this->render('education/index.html.twig', [
            'education' => $education,
            'form' => $form->createView(),
            'educations' => $this->getUser()->getEducations(),
        ]);
    }

    /**
     * @Route("/formations/{id}", name="education_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Education $education, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $education->getId(), (string) $request->request->get('token'))) {
            $entityManager->remove($education);
            $entityManager->flush();

            $this->addFlash(
                'delete-success',
                'Votre formation a été supprimé'
            );
        }

        return $this->redirectToRoute('education_index');
    }
}
