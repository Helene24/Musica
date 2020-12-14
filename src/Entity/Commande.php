<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_ht;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_ttc;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;

    /**
     * @ORM\OneToOne(targetEntity=Produit::class, inversedBy="commande", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $produits;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixHt(): ?float
    {
        return $this->prix_ht;
    }

    public function setPrixHt(float $prix_ht): self
    {
        $this->prix_ht = $prix_ht;

        return $this;
    }

    public function getPrixTtc(): ?float
    {
        return $this->prix_ttc;
    }

    public function setPrixTtc(float $prix_ttc): self
    {
        $this->prix_ttc = $prix_ttc;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getProduits(): ?Produit
    {
        return $this->produits;
    }

    public function setProduits(Produit $produits): self
    {
        $this->produits = $produits;

        return $this;
    }
}
