<?php

/**
 * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="prixInters")
 * @ORM\JoinColumn(nullable=false)
 */
private $Produit;

/**
 * @ORM\ManyToOne(targetEntity=Intervention::class, inversedBy="prixInters")
 * @ORM\JoinColumn(nullable=false)
 */
private $Intervention;

/**
 * @ORM\Column(type="time", nullable=true)
 */
private $duree;

public function getProduit(): ?Produit
{
    return $this->Produit;
}

public function setProduit(?Produit $Produit): self
{
    $this->Produit = $Produit;

    return $this;
}

public function getIntervention(): ?Intervention
{
    return $this->Intervention;
}

public function setIntervention(?Intervention $Intervention): self
{
    $this->Intervention = $Intervention;

    return $this;
}

public function getDuree(): ?\DateTimeInterface
{
    return $this->duree;
}

public function setDuree(?\DateTimeInterface $duree): self
{
    $this->duree = $duree;

    return $this;
}