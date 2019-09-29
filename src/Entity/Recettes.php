<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecettesRepository")
 */
class Recettes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $tempsDePreparation;

    /**
     * @ORM\Column(type="integer")
     */
    private $tempsDeCuisson;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etapes", inversedBy="recettes")
     */
    private $etape;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ustensiles", inversedBy="recettes")
     */
    private $ustensile;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredients", inversedBy="recettes")
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avis", inversedBy="recettes")
     */
    private $avi;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="recettes")
     */
    private $tag;
    
    public function __construct()
    {
        $this->ustensile = new ArrayCollection();
        $this->ingredient = new ArrayCollection();
        $this->tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTempsDePreparation(): ?int
    {
        return $this->tempsDePreparation;
    }

    public function setTempsDePreparation(int $tempsDePreparation): self
    {
        $this->tempsDePreparation = $tempsDePreparation;

        return $this;
    }

    public function getTempsDeCuisson(): ?int
    {
        return $this->tempsDeCuisson;
    }

    public function setTempsDeCuisson(int $tempsDeCuisson): self
    {
        $this->tempsDeCuisson = $tempsDeCuisson;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtape(): ?Etapes
    {
        return $this->etape;
    }

    public function setEtape(?Etapes $etape): self
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * @return Collection|Ustensiles[]
     */
    public function getUstensile(): Collection
    {
        return $this->ustensile;
    }

    public function addUstensile(Ustensiles $ustensile): self
    {
        if (!$this->ustensile->contains($ustensile)) {
            $this->ustensile[] = $ustensile;
        }

        return $this;
    }

    public function removeUstensile(Ustensiles $ustensile): self
    {
        if ($this->ustensile->contains($ustensile)) {
            $this->ustensile->removeElement($ustensile);
        }

        return $this;
    }

    /**
     * @return Collection|Ingredients[]
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredients $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): self
    {
        if ($this->ingredient->contains($ingredient)) {
            $this->ingredient->removeElement($ingredient);
        }

        return $this;
    }

    public function getAvi(): ?Avis
    {
        return $this->avi;
    }

    public function setAvi(?Avis $avi): self
    {
        $this->avi = $avi;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tag->contains($tag)) {
            $this->tag->removeElement($tag);
        }

        return $this;
    }
}
