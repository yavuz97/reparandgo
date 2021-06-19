<?php

namespace App\Entity;

use App\Repository\PrixInterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrixInterRepository::class)
 */
class PrixInter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Intervention::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $intervention;

    /**
     * @ORM\OneToOne(targetEntity=Produit::class, inversedBy="prixInter", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Produit;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntervention(): ?Intervention
    {
        return $this->intervention;
    }

    public function setIntervention(Intervention $intervention): self
    {
        $this->intervention = $intervention;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->Produit;
    }

    public function setProduit(Produit $Produit): self
    {
        $this->Produit = $Produit;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
