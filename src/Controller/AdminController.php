<?php

namespace App\Controller;


use App\Repository\SubjectRepository;
use App\Repository\ClassroomRepository;
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
      #[Route('/classroom', name: 'admin_classroom')]
      public function adminClassroom (ClassroomRepository $ClassroomRepository):Response {
          $classes=$ClassroomRepository->findAll();
          return $this->render('admin/classroom.html.twig',
              [
                  'classes' => $classes
              ]);
        }
}
