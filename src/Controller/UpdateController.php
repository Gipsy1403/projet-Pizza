<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdateController extends AbstractController
{

    #[Route('/add/pizza/(id)', name: 'update_pizza')]
    public function modify(pizza $pizza,Request $request, EntityManagerInterface $entityManager): Response
    {
	$form=$this->createform(CarteType::class,$pizza);
	$form->handleRequest($request);
	if($form->isSubmitted()&& $form->isValid()){
		$entityManager->persist($pizza);
		$entityManager->flush();
		$this->addFlash("success","Pizza modifiée avec succès !");
		return $this->redirectToRoute("accueil");
	}
	return $this->render("accueil/index.html.twig", [
		"carte"=>$form->createView(),
	]);
    }
}
