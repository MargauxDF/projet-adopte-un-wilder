<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\User;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/account", name="")
 */
class ExperienceController extends AbstractController
{
    /**
     * @Route("/experiences", name="experience_index")
     */
    public function index(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('experience/index.html.twig', [
            'experiences' => $this->getUser()->getExperiences(),
        ]);
    }

    /**
     * @Route("/experience/add", name="experience_add", methods={"GET", "POST"})
     */
    public function addExperience(Request $request, EntityManagerInterface $entityManager, ExperienceRepository $experienceRepository): Response
    {
        $experience = new Experience();

        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        $experience->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($experience);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre expérience a été ajoutée avec succès !'
            );

            return $this->redirectToRoute('experience_index');
        }

        return $this->render('experience/add.html.twig', [
            'form' => $form->createView(),
            'experiences' => $this->getUser()->getExperiences(),
        ]);
    }

    /**
     * @Route("/experience/{id}/edit", name="experience_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, Experience $experience, ExperienceRepository $experienceRepository): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre expérience a été mise à jour avec succès !'
            );

            return $this->redirectToRoute('experience_index');
        }

        return $this->render('experience/edit.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
            'experiences' => $this->getUser()->getExperiences(),
        ]);
    }

    /**
     * @Route("/experience/{id}", name="experience_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Experience $experience, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $experience->getId(), (string) $request->request->get('_token'))) {
            $entityManager->remove($experience);
            $entityManager->flush();

            $this->addFlash(
                'delete-success',
                'Votre expérience a été supprimée avec succcès !'
            );
        }

        return $this->redirectToRoute('experience_index');
    }
}
