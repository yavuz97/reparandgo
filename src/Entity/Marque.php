<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
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
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="marque")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=Serie::class, mappedBy="marque", orphanRemoval=true)
     */
    private $series;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->series = new ArrayCollection();
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
            $produit->setMarque($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getMarque() === $this) {
                $produit->setMarque(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Serie[]
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSerie(Serie $serie): self
    {
        if (!$this->series->contains($serie)) {
            $this->series[] = $serie;
            $serie->setMarque($this);
        }

        return $this;
    }

    public function removeSerie(Serie $serie): self
    {
        if ($this->series->removeElement($serie)) {
            // set the owning side to null (unless already changed)
            if ($serie->getMarque() === $this) {
                $serie->setMarque(null);
            }
        }

        return $this;
    }


    public function __toString(){
        return $this->nom;
    }

}
