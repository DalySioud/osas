<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DepenseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Service\ConversionService;

#[ORM\Entity(repositoryClass: DepenseRepository::class)]
#[ApiResource]
class Depense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;
    
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $date_ajout;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $date_fin = null;


    #[ORM\Column]
    private ?bool $payment = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null;


    public function getId(): ?int
    {
        return $this->id;
    }
   
    private $conversionService;

  

    public function getDateAjout(): ?\DateTimeImmutable
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTimeImmutable $date_ajout): self
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }

     public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function isPayment(): ?bool
    {
        return $this->payment;
    }

    public function setPayment(bool $payment): static
    {
        $this->payment = $payment;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }
    
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }



    

    // Transient property for Prix en Dinar
    public ?int $prixEnDinar = null;

    // Get the converted value for Prix en Dinar
    public function getPrixEnDinar(): ?int
    {
        // Get the conversion rate from the service
        $conversionRate = $this->conversionService->getDollarToDinarConversionRate();

        // Calculate the converted value
        $prixEnDollar = $this->prix ?? 0;
        $this->prixEnDinar = (int) round($prixEnDollar * $conversionRate);

        return $this->prixEnDinar;
    }

}