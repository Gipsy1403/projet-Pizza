<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordEncoder): Response
    {
    $inscription= new User();
    $form=$this->createform(InscriptionType::class,$inscription);
    $form->handleRequest($request);
    if($form->isSubmitted()&& $form->isValid()){
	    $entityManager->persist($inscription);
	    $entityManager->flush();
	    $this->addFlash("success","Votre compte a été créé avec succès !");
	    return $this->redirectToRoute("accueil");
    }
    return $this->render("inscription/inscription.html.twig", [
	    "inscription"=>$form->createView(),
    ]);
	}
}
