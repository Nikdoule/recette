<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtapesRepository")
 */
class Etapes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $spot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recettes", inversedBy="etapes")
     */
    private $recettes;

    public function __toString() {
        
        return $this->contenu;
   }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getSpot(): ?int
    {
        return $this->spot;
    }

    public function setSpot(?int $spot): self
    {
        $this->spot = $spot;

        return $this;
    }

    public function getRecettes(): ?Recettes
    {
        return $this->recettes;
    }

    public function setRecettes(?Recettes $recettes): self
    {
        $this->recettes = $recettes;

        return $this;
    }
}
