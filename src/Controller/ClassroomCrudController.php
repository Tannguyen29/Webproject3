<?php

namespace App\Controller;
use App\Form\ClassType;
use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Classroom;

class ClassroomCrudController extends AbstractController
{
    #[Route('/classroom/crud', name: 'app_classroom_crud')]
    public function index(): Response
    {
        return $this->render('classroom_crud/index.html.twig', [
            'controller_name' => 'ClassroomCrudController',
        ]);
    }
    #[Route('/edit/{id}', name: 'classroom_edit')]
    public function classroomEdit ($id, ClassroomRepository $ClassroomRepository, Request $request, ManagerRegistry $managerregistry):Response{
        $class = $ClassroomRepository->find($id);
        if ($class == null){
            $this->addFlash('Warning', 'This class does not existed!');
            return $this->redirectToRoute('app_classroom_crud');
        }
        else{
            $form = $this->createForm(ClassType::class,$class);
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $manager = $managerregistry->getManager();
                $manager->persist($class);
                $manager->flush();
                $this->addFlash('Info', 'Edit class info successfully');
                return $this->redirectToRoute('admin_classroom');
            }
            return $this->renderForm('classroom_crud/edit.html.twig',
            [
                'classForm' => $form
            ]);
        }
    
    }
    #[Route('/delete/{id}', name: 'classroom_delete')]
    public function classroomDelete ($id, ManagerRegistry $managerRegistry) {
      $class = $managerRegistry->getRepository(Classroom::class)->find($id);
      if ($class == null) {
          $this->addFlash('Warning', 'class not existed !');
      
      } else {
          $manager = $managerRegistry->getManager();
          $manager->remove($class);
          $manager->flush();
          $this->addFlash('Info', 'Delete users successfully !');
      }
      return $this->redirectToRoute('admin_classroom');
    }
}
