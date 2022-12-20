<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class StudentCrudController extends AbstractController
{
    #[Route('/crud', name: 'app_student_crud')]
    public function studentindex (UserRepository $UserRepository):Response {
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
    

  #[Route('/delete/{id}', name: 'student_delete')]
  public function studentDelete ($id, ManagerRegistry $managerRegistry) {
    $users = $managerRegistry->getRepository(User::class)->find($id);
    if ($users == null) {
        $this->addFlash('Warning', 'users not existed !');
    
    } else {
        $manager = $managerRegistry->getManager();
        $manager->remove($users);
        $manager->flush();
        $this->addFlash('Info', 'Delete users successfully !');
    }
    return $this->redirectToRoute('app_student_crud');
  }

  #[Route('/edit/{id}', name: 'student_edit')]
  public function studentEdit ($id , UserRepository $UserRepository, Request $request,  ManagerRegistry $managerRegistry):Response {
    $users = $UserRepository->find($id);
    if ($users == null) {
        $this->addFlash('Warning', 'users not existed !');
        return $this->redirectToRoute('app_student_crud');
    } else {
        $form = $this->createForm(UserType::class,$users);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $managerRegistry->getManager();
            $manager->persist($users);
            $manager->flush();
            $this->addFlash('Info','Edit users successfully !');
            return $this->redirectToRoute('app_student_crud');
        }
        return $this->renderForm('student_crud/edit.html.twig',
        [
            'userForm' => $form
        ]);
    }
}
}