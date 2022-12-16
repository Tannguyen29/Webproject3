<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentFunctionController extends AbstractController
{
    #[Route('/student/show', name: 'app_student_function')]
    public function index(): Response
    {
        return $this->render('student_function/index.html.twig', [
            'controller_name' => 'StudentFunctionController',
        ]);
    }

    #[Route('/student/show', name: 'show_student')]
    public function show(UserRepository $UserRepository): Response
    {
        $users=$UserRepository->findAll();
        return $this->render('student_function/index.html.twig',
        [
            'users' => $users
        ]);
    }
}
