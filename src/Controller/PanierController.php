<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier = $session->get('panier', []);
        $panierAvecDonnees = [];

        foreach ($panier as $id => $quantite)
        {
            $panierAvecDonnees[] = [
                'produit'=> $produitRepository->find($id),
                'quantite'=> $quantite
            ];
        }

        $total = 0;
        foreach ($panierAvecDonnees as $item)
        {
            $totalItem = $item['produit']->getPrixVente() * $item['quantite'];
            $total += $totalItem;
        }



        return $this->render('panier/index.html.twig', [
            'items' => $panierAvecDonnees,
            'total' => $total

        ]);
    }

    /**
     * @Route("/panier/ajout/{id}", name="ajoutProduit")
     */
    public function ajout($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/panier/retrait/{id}", name="retraitProduit")
     */
    public function retraitProd($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/panier/supprime/{id}", name="supprProduit")
     */
    public function supprime($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("panier");
    }




}

