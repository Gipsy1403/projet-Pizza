<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PizzacreaController extends AbstractController
{
    #[Route('pizzacrea', name: 'pizzacrea')]
    public function read(PizzaRepository $repository): Response
    {
	$pizzas=$repository->findAll();
        return $this->render('pizzacrea/pizzacrea.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }

   
}
