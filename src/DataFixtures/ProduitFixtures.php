<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;


class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
            for($i=1; $i<=7; $i++)
            {
                $fournisseur = new Fournisseur();
                $fournisseur->setNom($faker->sentence());
                    $manager->persist($fournisseur);

                $categorie = new Categorie();
                $categorie->setNom($faker->sentence());
                    $manager->persist($categorie);

                    for($j=1; $j<=mt_rand(4, 6); $j++)
                    {
                        $produit = new Produit();
                        $contenu = '<p>' .join($faker->paragraphs(3), '</p><p>') .'</p>';

                        $produit->setLibelleCourt($faker->sentence())
                                ->setLibelleLong($contenu)
                                ->setPrixAchat($faker->randomFloat())
                                ->setPrixVente($faker->randomFloat())
                                ->setPhoto($faker->imageUrl())
                                ->setCreation($faker->dateTimeBetween('-6 months'))
                                ->setFournisseur($fournisseur)
                                ->setCategorieId($categorie);
                        $manager->persist($produit);

                    }
            }
        $manager->flush();
    }
}
