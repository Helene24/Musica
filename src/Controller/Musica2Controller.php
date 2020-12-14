<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class Musica2Controller extends AbstractController
{
    /**
     * @Route("/musica2", name="musica2")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $repo->findAll();

        return $this->render('musica2/index.html.twig', [
            'controller_name' => 'BlogController',
            'produits' => $produits]);
    }


    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('musica2/home.html.twig');
    }

    /**
     * @Route ("/musica2/CreationProd", name="CreationProd")
     * @Route ("/musica2/{id}/modif", name="ModifProd")
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     * @IsGranted("ROLE_GESTION")
     */
    public function CreatModifProd(Produit $produit=null, Request $request)
    {
        if(!$produit)
        {
            $produit = new Produit();
        }

        $form = $this ->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if(!$produit->getId()){
                $produit->setCreation(new\DateTime());
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($produit);
            $manager->flush();

            return $this->redirectToRoute('DetailArt',
                ['id' => $produit->getId()]);
        }

        return $this->render('musica2/creationProd.html.twig',
            ['formProduit'=> $form->createView(),
                'editMode' => $produit->getId() !==null]);
    }

    /**
     * @Route ("/musica2/{id}", name="DetailArt")
     */
    public function DetailArt($id)
    {
        $repo = $this->getDoctrine()->getRepository(Produit::class);
        $produit = $repo->find($id);
        return $this->render('musica2/detailArt.html.twig',
            ['produit' => $produit]);
    }

    /**
     * @Route("/delete/{id}", name="produitSupprime")
     * @return Response
     */
    public function delete(Produit $produit)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('musica2');
    }

}
