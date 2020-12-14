<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="client")
     */
    private $id_adresse;

    /**
     * @ORM\OneToOne(targetEntity=Commercial::class, inversedBy="client", cascade={"persist", "remove"})
     */
    private $id_commercial;

    public function __construct()
    {
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $idAdresse->setClient($this);
        }

        return $this;
    }

    public function removeIdAdresse(Adresse $idAdresse): self
    {
        if ($this->id_adresse->removeElement($idAdresse)) {
            // set the owning side to null (unless already changed)
            if ($idAdresse->getClient() === $this) {
                $idAdresse->setClient(null);
            }
        }

        return $this;
    }

    public function getIdCommercial(): ?Commercial
    {
        return $this->id_commercial;
    }

    public function setIdCommercial(?Commercial $id_commercial): self
    {
        $this->id_commercial = $id_commercial;

        return $this;
    }
}
