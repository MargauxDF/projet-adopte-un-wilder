<?php
namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Service\FileUploader;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account", name="")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/projects", name="project_index")
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $this->getUser()->getProjects(),
        ]);
    }

    /**
     * @Route("/project/add", name="project_add", methods={"GET", "POST"})
     */
    public function addProject(Request $request, EntityManagerInterface $entityManager,  FileUploader $fileUploader): Response
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        $project->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $pictureFile */
            $pictureFile = $form->get('picture')->getData();
            if ($pictureFile) {
                $pictureFileName = $fileUploader->upload($pictureFile);
                $project->setPictureFilename($pictureFileName);
            }
            $entityManager->persist($project);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre projet a été ajouté avec succès !'
            );

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/add.html.twig', [
            'form' => $form->createView(),
            'projects' => $this->getUser()->getProjects(),
        ]);
    }

    /**
     * @Route("/project/{id}/edit", name="project_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request,
                         EntityManagerInterface $entityManager,
                         Project $project,
                         FileUploader $fileUploader
    ): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $pictureFile */
            $pictureFile = $form->get('picture')->getData();
            if ($pictureFile) {
                $pictureFileName = $fileUploader->upload($pictureFile);
                $project->setPictureFilename($pictureFileName);
            }

            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre projet a été mise à jour avec succès !'
            );

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'projects' => $this->getUser()->getProjects(),
        ]);
    }

    /**
     * @Route("/project/{id}", name="project_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $project->getId(), (string) $request->request->get('_token'))) {
            $entityManager->remove($project);
            $entityManager->flush();

            $this->addFlash(
                'delete-success',
                'Votre projet a été supprimée avec succcès !'
            );
        }

        return $this->redirectToRoute('project_index');
    }
}