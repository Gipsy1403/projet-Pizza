<?php

namespace App\Controller;


use App\Entity\Pizza;
use App\Form\CarteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PizzacreaController extends AbstractController
{
   

    #[Route('pizzacrea', name: 'pizzacrea')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
  {
   $pizza= new Pizza();
   $form=$this->createform(CarteType::class,$pizza);
   $form->handleRequest($request);
   if($form->isSubmitted()&& $form->isValid()){
	   $entityManager->persist($pizza);
	   $entityManager->flush();
	   $this->addFlash("success","Pizza ajoutée avec succès !");
	   return $this->redirectToRoute("accueil");
   }
   return $this->render("pizzacrea/pizzacrea.html.twig", [
	   "carte"=>$form->createView(),
   ]);
  }   
}
