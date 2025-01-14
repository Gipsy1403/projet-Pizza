<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
	#[Route('/inscription', name: 'inscription')]
	public function create(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
   {
    $user= new User();
   
    $form=$this->createform(InscriptionType::class,$user);
    
    $form->handleRequest($request);
    if($form->isSubmitted()&& $form->isValid()){
		$user->setRoles(["ROLE_USER"]);
		$user->setPassword(
			$passwordEncoder->hashPassword($user, $form->get("password")->getData()));
	    $entityManager->persist($user);
	    $entityManager->flush();
	    $this->addFlash("success","Votre compte a été créé avec succès !");
	    return $this->redirectToRoute("accueil");
    }
    return $this->render("inscription/inscription.html.twig", [
	    "inscription"=>$form->createView(),
    ]);
   }   

    #[Route(path: '/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
		
	//    return $this->redirectToRoute("accueil");

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
	  
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');

	}
}
