<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\CarteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateController extends AbstractController
{

    #[Route('/add/pizza/{id}', name: 'update_pizza')]
    public function modify(Pizza $pizza,Request $request, EntityManagerInterface $entityManager): Response
    {
	$form=$this->createform(CarteType::class,$pizza);
	$form->handleRequest($request);
	if($form->isSubmitted()&& $form->isValid()){
		$entityManager->persist($pizza);
		$entityManager->flush();
		$this->addFlash("success","Pizza modifiée avec succès !");
		return $this->redirectToRoute("accueil");
	}
	return $this->render("update/update.html.twig", [
		"carte"=>$form->createView(),
	]);
    }
}
