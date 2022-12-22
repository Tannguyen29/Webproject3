<?php

namespace App\Controller;

use App\Entity\Report;
use App\Form\FeedbackType;
use App\Repository\ReportRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FeedbackController extends AbstractController
{
    #[Route('/feedback', name: 'app_feedback')]
    public function feedbackindex (ReportRepository $ReportRepository):Response {
        $feedback=$ReportRepository->findAll();
        return $this->render('feedback/index.html.twig',
            [
                'feedback' => $feedback
            ]);
      }

      #[Route('/feedback/add', name: 'feedback_add')]
      public function feedbackAdd (Request $request, ManagerRegistry $managerRegistry):Response {
        $feedback = new Report;
        $form = $this->createForm(FeedbackType::class,$feedback);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $managerRegistry->getManager();
            $manager->persist($feedback);
            $manager->flush();
            $this->addFlash('Info','Add feedback successfully !');
            return $this->redirectToRoute('app_student');
        }
        return $this->renderForm('feedback/feedback_add.html.twig',
        [
            'feedbackForm' => $form
        ]);
}

#[IsGranted("ROLE_ADMIN")]
#[Route('feedback/detail/{id}', name: 'feedback_detail')]
public function feedbackDetail ($id, ReportRepository $ReportRepository) {
  $feedback = $ReportRepository->find($id);
  if ($feedback== null) {
      $this->addFlash('Warning', 'Invalid feedback id !');
      return $this->redirectToRoute('app_admin');
  }
  return $this->render('feedback/feedback_detail.html.twig',
      [
          'feedback' => $feedback
      ]);
}
#[IsGranted("ROLE_ADMIN")]
#[Route('feedback/delete/{id}', name: 'feedback_delete')]
public function feedbackDelete ($id, ManagerRegistry $managerRegistry) {
  $feedback = $ReportRepository->getRepository(FeedbackType::class)->find($id);
  if ($feedback == null) {
      $this->addFlash('Warning', 'users not existed !');
  
  } else {
      $manager = $managerRegistry->getManager();
      $manager->remove($feedback);
      $manager->flush();
      $this->addFlash('Info', 'Delete users successfully !');
  }
  return $this->redirectToRoute('app_feedback');
}
}
