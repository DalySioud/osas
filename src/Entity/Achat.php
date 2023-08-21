<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    
      #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: "achats")]
      #[ORM\JoinColumn(name: "commande", referencedColumnName: "id", onDelete:"CASCADE")]
    private $commande;


     #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: "achats")]
     #[ORM\JoinColumn(name: "product", referencedColumnName: "id") ]
    private $product;

    #[ORM\Column(type: 'integer')]
    private int $quantite;

    // Getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getProduct(): ?product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}