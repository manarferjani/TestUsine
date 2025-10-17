<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UsineRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Usine;
use App\Form\AddEditUsineType;



final class UsineFerjaniManarController extends AbstractController
{
    #[Route('/usine', name: 'app_usine_ferjani_manar')]
    public function index(): Response
    {
        return $this->render('usine_ferjani_manar/index.html.twig', [
            'controller_name' => 'UsineFerjaniManarController',
        ]);
    }

    #[Route('/usine/list', name:'app_usine_list')]
    public function usineList(usineRepository $usineRepository): Response{
        $usines = $usineRepository->findAll();
        return $this->render('usine_ferjani_manar/list.html.twig', [
            'usines' => $usines,
        ]);
    }

    #[Route('/usine/details/{id}', name:'app_usine_details')]
    public function UsineDetails($id, usineRepository $usineRepository): Response{
 
        $usine = $usineRepository->find($id);
        return $this->render('usine_ferjani_manar/details.html.twig',[
            'title' => 'UsineFerjaniManar Details',
            'usine' => $usine,
        ]);
    }

    #[Route('/usine/create', name:'app_usine_create')]
    public function usineCreate(Request $request, EntityManagerInterface $em){
        $usine = new Usine();

        $form = $this->createForm(AddEditUsineType::class, $usine);
        $form->handleRequest($request);
        if($form->isSubmitted()){
           $em->persist($usine);
           $em->flush();
           return $this->redirectToRoute('app_usine_list');
        }
        return $this->render('usine_ferjani_manar/form.html.twig', [
            'title'=> 'Create Usine',
            'form' => $form
        ]);
    }
     #[Route('/usine/update/{id}', name:'app_usine_update')]
    public function updateCreate($id, Request $request, EntityManagerInterface $em, UsineRepository $usineRepository){
        $usine = $usineRepository->find($id);

        $form = $this->createForm(AddEditUsineType::class, $usine);
        $form->handleRequest($request);
        if($form->isSubmitted()){
           //$em->persist($usine);
           $em->flush();
           return $this->redirectToRoute('app_usine_list');
        }
        return $this->render('usine_ferjani_manar/form.html.twig', [
            'title'=> 'Update usine',
            'form' => $form
        ]);
    }

    #[Route('/usine/edit/{id}', name:'app_usine_edit')]
    public function usineEdit($id, EntityManagerInterface $em, UsineRepository $usineRepository){
        $usine = $usineRepository->find($id);
        //$usine->setNbBooks(450);
        $em->persist($usine);
        $em->flush();
        dd($usine);
    }

    #[Route('/usine/delete/{id}', name:'app_usine_delete')]
    public function usineDelete($id, EntityManagerInterface $em, UsineRepository $usineRepository){
        $usine = $usineRepository->find($id);
        $em->remove($usine);
        $em->flush();
        //dd('Author Deleted');
        return $this->redirectToRoute('app_usine_list');
    }

}
