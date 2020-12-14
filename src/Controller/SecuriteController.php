<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecuriteController extends AbstractController
{
    /**
     * @Route("/inscription", name="securiteInscription")
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();

        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('securite_login');
        }

        return $this->render('securite/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/connexion", name="securite_login")
     */
    public function login()
    {
        return $this->render('securite/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="securite_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute('securite_login');
    }
}
