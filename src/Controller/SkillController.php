<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Skill;
use App\Form\SkillType;

class SkillController extends AbstractController
{
    /**
     * @Route("/skill", name="skill")
     */
    public function index(): Response
    {
        $skill = new Skill();
        // Create the associated Form
        $form = $this->createForm(SkillType::class, $skill);
        // Render the form
        return $this->render('skill/index.html.twig', [
        "form" => $form->createView(),
        ]);
    }
}
