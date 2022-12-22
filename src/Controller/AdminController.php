<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\CurriculumType;
use App\Repository\SubjectRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    #[Route('/curriculum', name: 'admin_curriculum')]
    public function adminCurriculum (SubjectRepository $SubjectRepository):Response {
        $subjects=$SubjectRepository->findAll();
        return $this->render('admin/curriculum.html.twig',
            [
                'subjects' => $subjects
            ]);
      }


      #[Route('/delete/{id}', name: 'curriculum_delete')]
      public function studentDelete ($id, ManagerRegistry $managerRegistry) {
        $curriculum = $managerRegistry->getRepository(Subject::class)->find($id);
        if ($curriculum == null) {
            $this->addFlash('Warning', 'curriculum not existed !');
        
        } else {
            $manager = $managerRegistry->getManager();
            $manager->remove($curriculum);
            $manager->flush();
            $this->addFlash('Info', 'Delete curriculum successfully !');
        }
        return $this->redirectToRoute('admin_curriculum');
      }


      #[Route('/edit/{id}', name: 'curriculum_edit')]
      public function studentEdit ($id , SubjectRepository $SubjectRepository, Request $request,  ManagerRegistry $managerRegistry):Response {
        $curriculum = $SubjectRepository->find($id);
        if ($curriculum == null) {
            $this->addFlash('Warning', 'curriculum not existed !');
            return $this->redirectToRoute('admin_curriculum');
        } else {
            $form = $this->createForm(CurriculumType::class,$curriculum);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $managerRegistry->getManager();
                $manager->persist($curriculum);
                $manager->flush();
                $this->addFlash('Info','Edit curriculum successfully !');
                return $this->redirectToRoute('admin_curriculum');
            }
            return $this->renderForm('admin/curriculum_edit.html.twig',
            [
                'curriculumForm' => $form
            ]);
        }
    }


    #[Route('/add', name: 'curriculum_add')]
    public function curriculumAdd (Request $request, ManagerRegistry $managerRegistry):Response {
      $curriculum = new Subject;
      $form = $this->createForm(CurriculumType::class,$curriculum);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $manager = $managerRegistry->getManager();
          $manager->persist($curriculum);
          $manager->flush();
          $this->addFlash('Info','Add curriculum successfully !');
          return $this->redirectToRoute('admin_curriculum');
      }
      return $this->renderForm('admin/curriculum_add.html.twig',
      [
          'curriculumForm' => $form
      ]);

      
    }
  
}
