<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteController extends AbstractController
{
    #[Route('/suppr/pizza/(id)', name: 'delete_pizza')]
    public function delete(pizza $pizza,Request $request, EntityManagerInterface $entityManager): Response
    {
     if($this->isCsrfTokenValid("SUP". $pizza->getId(),$request->get("_token"))){
		$entityManager->remove($pizza);
		$entityManager->flush;
		$this->addFlash("success","La suppression de la pizza a été effectuée");
		return $this->redirectToRoute("pizzacrea");
	}
	}
}
