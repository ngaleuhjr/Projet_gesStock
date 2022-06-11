<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $qteSortie;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $prixSortie;

    #[ORM\Column(type: 'date')]
    private $dateSortie;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'sortie')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;
    
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'sorties')]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteSortie(): ?string
    {
        return $this->qteSortie;
    }

    public function setQteSortie(string $qteSortie): self
    {
        $this->qteSortie = $qteSortie;

        return $this;
    }

    public function getPrixSortie(): ?string
    {
        return $this->prixSortie;
    }

    public function setPrixSortie(string $prixSortie): self
    {
        $this->prixSortie = $prixSortie;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
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