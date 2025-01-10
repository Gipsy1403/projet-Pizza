<?php

namespace App\Controller;




use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
	#[Route('/', name: 'accueil')]
	public function read(PizzaRepository $repository): Response
	{
	 $pizzas=$repository->findAll();
	    return $this->render('accueil/index.html.twig', [
		   'pizzas' => $pizzas,
	    ]);
	}


}


