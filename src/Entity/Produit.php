<?php    namespace App\Entity;    use App\Repository\ProduitRepository;    use Doctrine\Common\Collections\ArrayCollection;    use Doctrine\Common\Collections\Collection;    use Doctrine\ORM\Mapping as ORM;    use Vich\UploaderBundle\Mapping\Annotation as Vich;    use Symfony\Component\HttpFoundation\File\File;    /**     * @ORM\Entity(repositoryClass=ProduitRepository::class)     * @Vich\Uploadable()     */    class Produit    {        /**         * @ORM\Id         * @ORM\GeneratedValue         * @ORM\Column(type="integer")         */        private $id;        /**         * @ORM\Column(type="string", length=255, nullable=true)         */        private $model;        /**         * @ORM\Column(type="string", length=255, nullable=true)         */        private $image;        /**         * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")         * @var File         */        private $imageFile;        /**         * @ORM\Column(type="datetime")         * @var \DateTime         */        private $updatedAt;        // ...        public function setImageFile(File $image = null)        {            $this->imageFile = $image;            // VERY IMPORTANT:            // It is required that at least one field changes if you are using Doctrine,            // otherwise the event listeners won't be called and the file is lost            if ($image) {                // if 'updatedAt' is not defined in your entity, use another property                $this->updatedAt = new \DateTime('now');            }        }        public function getImageFile()        {            return $this->imageFile;        }        /**         * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="produits")         */        private $marque;        /**         * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")         * @ORM\JoinColumn(nullable=false)         */        private $categorie;        /**         * @ORM\ManyToMany(targetEntity=Intervention::class, inversedBy="produits")         */        private $interventions;        /**         * @ORM\ManyToOne(targetEntity=Serie::class, inversedBy="produits")         */        private $serie;        /**         * @ORM\OneToMany(targetEntity=PrixInter::class, mappedBy="Produit", orphanRemoval=true)         */        private $prixInters;        public function __construct()        {            $this->interventions = new ArrayCollection();            $this->updatedAt = new \DateTime();            $this->prixInters = new ArrayCollection();        }        public function getId(): ?int        {            return $this->id;        }        public function getModel(): ?string        {            return $this->model;        }        public function setModel(?string $model): self        {            $this->model = $model;            return $this;        }        public function getImage(): ?string        {            return $this->image;        }        public function setImage(?string $image): self        {            $this->image = $image;            return $this;        }        public function getMarque(): ?Marque        {            return $this->marque;        }        public function setMarque(?Marque $marque): self        {            $this->marque = $marque;            return $this;        }        public function getCategorie(): ?Categorie        {            return $this->categorie;        }        public function setCategorie(?Categorie $categorie): self        {            $this->categorie = $categorie;            return $this;        }        /**         * @return Collection|Intervention[]         */        public function getInterventions(): Collection        {            return $this->interventions;        }        public function addIntervention(Intervention $intervention): self        {            if (!$this->interventions->contains($intervention)) {                $this->interventions[] = $intervention;            }            return $this;        }        public function removeIntervention(Intervention $intervention): self        {            $this->interventions->removeElement($intervention);            return $this;        }        public function getUpdatedAt(): ?\DateTimeInterface        {            return $this->updatedAt;        }        public function setUpdatedAt(\DateTimeInterface $updatedAt): self        {            $this->updatedAt = $updatedAt;            return $this;        }        public function getSerie(): ?Serie        {            return $this->serie;        }        public function setSerie(?Serie $serie): self        {            $this->serie = $serie;            return $this;        }        public function getNom()        {            $marque = $this->getMarque()->getNom();            $serie = $this->getSerie()->getNom();            $model = $this->getModel();            $nom = $marque . " " . $serie . " " . $model;            return $nom;        }        /**         * @return Collection|PrixInter[]         */        public function getPrixInters(): Collection        {            return $this->prixInters;        }        public function addPrixInter(PrixInter $prixInter): self        {            if (!$this->prixInters->contains($prixInter)) {                $this->prixInters[] = $prixInter;                $prixInter->setProduit($this);            }            return $this;        }        public function removePrixInter(PrixInter $prixInter): self        {            if ($this->prixInters->removeElement($prixInter)) {                // set the owning side to null (unless already changed)                if ($prixInter->getProduit() === $this) {                    $prixInter->setProduit(null);                }            }            return $this;        }    }