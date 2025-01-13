<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
	#[Route('/', name: 'accueil')]
	public function read(PizzaRepository $pizzaRepository): Response
	{
	    $pizzas = $pizzaRepository->findAll();

	
	    return $this->render('accueil/index.html.twig', [
		   'pizzas' => $pizzas,
	
	    ]);
	}
	
}


