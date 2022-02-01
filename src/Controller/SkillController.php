<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Skill;
use App\Form\SkillType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SkillRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;


/**
 * @Route("/account", name="")
 */
class SkillController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    /**
     * @Route("/skills", name="skills_index", methods={"GET", "POST"})
     */
    public function addSkills(Request $request, EntityManagerInterface $entityManager, SkillRepository $skillRepository): Response
    {
        $skill = new Skill();

        // Create the associated Form
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);
        $skill->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre compétence a été ajoutée!'
            );

            return $this->redirectToRoute('skills_index');
        }
        // Render the form
        return $this->render('skill/index.html.twig', [
        "form" => $form->createView(),
        'skills' => $this->getUser()->getSkills(),
        ]);
    }
        /**
     * @Route("/skills/{id}/edit", name="skill_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, Skill $skill, SkillRepository $skillRepository): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre compétence a été mise à jour avec succès !'
            );

            return $this->redirectToRoute('skills_index');
        }

        return $this->render('skill/index.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
            'skills' => $this->getUser()->getSkills(),
        ]);
    }
        /**
     * @Route("/skills/{id}", name="skill_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $skill->getId(), (string) $request->request->get('_token'))) {
            $entityManager->remove($skill);
            $entityManager->flush();

            $this->addFlash(
                'delete-success',
                'Votre compétence a été supprimée avec succcès !'
            );
        }

        return $this->redirectToRoute('skills_index');
    }
}
