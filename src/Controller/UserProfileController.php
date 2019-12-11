<?php

namespace App\Controller;

use App\Form\UserProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @IsGranted("ROLE_USER")
 * @Route("/profile", name="profile_")
 */
class UserProfileController extends AbstractController
{
    /**
     * @Route("/", name="edit")
     */
    public function index(EntityManagerInterface $em,  Request $request)
    {
        // Création du formulaire en passant les données (l'utilisateur courant)
        $user = $this->getUser();
        $profilform = $this->createForm(UserProfileFormType::class, $user);
        $profilform->handleRequest($request);

        // Si le formulaire est envoyé et valide
        if ($profilform->isSubmitted() && $profilform->isValid()){
            // Formulaire lié a une classe entité: getData() retourne l'entité
            $user = $profilform->getData();
            // dd($user);
            // Mise à jour de l'entité BDD
            $em->persist($user);
            $em->flush();

            // Ajout d'un message flash
            $this->addFlash('succes','votre profil a été mis à jour');
        }


        return $this->render('user/profile.html.twig', [
            'form_user' => $profilform->createView()
        ]);
    }
}
