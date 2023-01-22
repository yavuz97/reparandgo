<?phpnamespace App\Entity;use App\Repository\PrixInterRepository;use Doctrine\Common\Collections\ArrayCollection;use Doctrine\Common\Collections\Collection;use Doctrine\ORM\Mapping as ORM;/** * @ORM\Entity(repositoryClass=PrixInterRepository::class) */class PrixInter{    /**     * @ORM\Id     * @ORM\GeneratedValue     * @ORM\Column(type="integer")     */    private $id;    /**     * @ORM\Column(type="float", nullable=true)     */    private $prix;

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
private $duree;    public function getId(): ?int    {        return $this->id;    }    public function getPrix(): ?float    {        return $this->prix;    }    public function setPrix(?float $prix): self    {        $this->prix = $prix;        return $this;    }

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
}}