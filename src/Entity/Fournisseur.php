<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="fournisseur")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="fournisseur")
     */
    private $id_adresse;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->id_adresse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setFournisseur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getFournisseur() === $this) {
                $produit->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getIdAdresse(): Collection
    {
        return $this->id_adresse;
    }

    public function addIdAdresse(Adresse $idAdresse): self
    {
        if (!$this->id_adresse->contains($idAdresse)) {
            $this->id_adresse[] = $idAdresse;
            $idAdresse->setFournisseur($this);
        }

        return $this;
    }

    public function removeIdAdresse(Adresse $idAdresse): self
    {
        if ($this->id_adresse->removeElement($idAdresse)) {
            // set the owning side to null (unless already changed)
            if ($idAdresse->getFournisseur() === $this) {
                $idAdresse->setFournisseur(null);
            }
        }

        return $this;
    }
}
