<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentCrudController extends AbstractController
{
    #[Route('/student/crud', name: 'app_student_crud')]
    public function studentIndex (UserRepository $UserRepository):Response {
        $users= $UserRepository->findAll();
        return $this->render('student_crud/index.html.twig',
            [
                'users ' => $users 
            ]);
      }

    #[Route('/list', name: 'student_list')]
  public function studentList (UserRepository $UserRepository):Response {
    $users=$UserRepository->findAll();
    return $this->render('student_crud/index.html.twig',
        [
            'users' => $users
        ]);
  }

    #[Route('/detail/{id}', name: 'student_detail')]
    public function studentDetail ($id, UserRepository $UserRepository) {
      $users = $UserRepository->find($id);
      if ($users== null) {
          $this->addFlash('Warning', 'Invalid author id !');
          return $this->redirectToRoute('app_admin');
      }
      return $this->render('student_crud\detail.html.twig',
          [
              'users' => $users
          ]);
    }
}
