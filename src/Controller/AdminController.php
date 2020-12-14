<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use App\Form\ModifUserType;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(UserRepository $user)
    {
        return $this->render("admin/users.html.twig", [
            'users' => $user->findAll()
        ]);
    }

    /**
     * @Route("/utilisateur/modif/{id}", name="modifUser")
     */
    public function modifUtilisateur(User $user, Request $request)
    {
        $form = $this->createForm(ModifUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entitymanager = $this->getDoctrine()->getManager();
            $entitymanager->persist($user);
            $entitymanager->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès !');
            return $this->redirectToRoute('admin_utilisateurs');
        }
        return $this->render('admin/modifierUt.html.twig', [
            'userForm' => $form->createView()
        ]);
    }
}
