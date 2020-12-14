<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
     * @ORM\OneToOne(targetEntity=Categorie::class, inversedBy="categorie", cascade={"persist", "remove"})
     */
    private $id_parent;

    /**
     * @ORM\OneToOne(targetEntity=Categorie::class, mappedBy="id_parent", cascade={"persist", "remove"})
     */
    private $categorie;

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

    public function getIdParent(): ?self
    {
        return $this->id_parent;
    }

    public function setIdParent(?self $id_parent): self
    {
        $this->id_parent = $id_parent;

        return $this;
    }

    public function getCategorie(): ?self
    {
        return $this->categorie;
    }

    public function setCategorie(?self $categorie): self
    {
        $this->categorie = $categorie;

        // set (or unset) the owning side of the relation if necessary
        $newId_parent = null === $categorie ? null : $this;
        if ($categorie->getIdParent() !== $newId_parent) {
            $categorie->setIdParent($newId_parent);
        }

        return $this;
    }
}
