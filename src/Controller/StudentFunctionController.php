<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\SubjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentFunctionController extends AbstractController
{
    #[Route('/student/show', name: 'app_student_function')]
    public function index(): Response
    {
        return $this->render('student_function/index.html.twig', [
            'controller_name' => 'StudentFunctionController',
        ]);
    }

    #[Route('/detail', name: 'acc_detail')]
    public function studentDetail ($email, UserRepository $UserRepository) {
      $users = $UserRepository->find($email);
      if ($users== null) {
          $this->addFlash('Warning', 'Invalid author id !');
          return $this->redirectToRoute('app_student');
      }
      return $this->render('student_function/detail.html.twig',
          [
              'users' => $users
          ]);
    }

    #[Route('/curriculum', name: 'student_curriculum')]
    public function studentCurriculum (SubjectRepository $SubjectRepository):Response {
        $subjects=$SubjectRepository->findAll();
        return $this->render('student_function/curriculum.html.twig',
            [
                'subjects' => $subjects
            ]);
      }

    #[Route('/schedule', name: 'student_schedule')]
    public function studentSchedule (SubjectRepository $SubjectRepository):Response {
        $subjects=$SubjectRepository->findAll();
        return $this->render('student_function/schedule.html.twig',
            [
                'subjects' => $subjects
            ]);
      }
}
