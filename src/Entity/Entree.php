<?php

namespace App\Entity;

use App\Repository\EntreeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntreeRepository::class)]
class Entree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $qteEntree;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $prix;

    #[ORM\Column(type: 'date')]
    private $dateEntree;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'entree')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'entrees')]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteEntree(): ?string
    {
        return $this->qteEntree;
    }

    public function setQteEntree(string $qteEntree): self
    {
        $this->qteEntree = $qteEntree;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

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