<?php

namespace App\Entity;

use App\Entity\Categorie;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $stock;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Entree::class)]
    private $entree;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Sortie::class, orphanRemoval: true)]
    private $sortie;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'produits')]
    private $user;

    public function __construct()
    {
        $this->entree = new ArrayCollection();
        $this->sortie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(string $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, Entree>
     */
    public function getEntree(): Collection
    {
        return $this->entree;
    }

    public function addEntree(Entree $entree): self
    {
        if (!$this->entree->contains($entree)) {
            $this->entree[] = $entree;
            $entree->setProduit($this);
        }

        return $this;
    }

    public function removeEntree(Entree $entree): self
    {
        if ($this->entree->removeElement($entree)) {
            // set the owning side to null (unless already changed)
            if ($entree->getProduit() === $this) {
                $entree->setProduit(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Sortie>
     */
    public function getSortie(): Collection
    {
        return $this->sortie;
    }

    public function addSortie(Sortie $sortie): self
    {
        if (!$this->sortie->contains($sortie)) {
            $this->sortie[] = $sortie;
            $sortie->setProduit($this);
        }

        return $this;
    }

    public function removeSortie(Sortie $sortie): self
    {
        if ($this->sortie->removeElement($sortie)) {
            // set the owning side to null (unless already changed)
            if ($sortie->getProduit() === $this) {
                $sortie->setProduit(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }



    /**
     * Get the value of user
     */ 
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}