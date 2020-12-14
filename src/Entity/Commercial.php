<?php

namespace App\Entity;

use App\Repository\CommercialRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommercialRepository::class)
 */
class Commercial
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
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, mappedBy="id_commercial", cascade={"persist", "remove"})
     */
    private $client;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        // set (or unset) the owning side of the relation if necessary
        $newId_commercial = null === $client ? null : $this;
        if ($client->getIdCommercial() !== $newId_commercial) {
            $client->setIdCommercial($newId_commercial);
        }

        return $this;
    }
}
