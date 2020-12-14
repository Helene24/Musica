<?php

namespace App\Form;

use App\Entity\Fournisseur;
use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleCourt')
            ->add('libelleLong')
            ->add('prixAchat')
            ->add('prixVente')
            ->add('photo')
            ->add('categorieId', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' =>'nom'
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' =>'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
