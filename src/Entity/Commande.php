<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;
    
    #[ORM\Column(type: 'string')]
    private ?String $NomClient;

    #[ORM\Column(type: 'integer')]
    private ?int $numtel;

    #[ORM\Column(type: 'string')]
    private ?string $gouvernorat;


    #[ORM\Column(type: 'string')]
    private ?string $adresse;


    public function getId(): ?int
    {
        return $this->id;
    }
   

  

    public function getNomClient(): ?string
    {
        return $this->NomClient;
    }

    public function setNomClient(string $NomClient): self
    {
        $this->NomClient = $NomClient;

        return $this;
    }

     public function getnumtel(): ?int
    {
        return $this->numtel;
    }

    public function setnumtel(int $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getgouvernorat(): ?string
    {
        return $this->gouvernorat;
    }

    public function setgouvernorat(string $gouvernorat): self
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    public function getadresse(): ?string
    {
        return $this->adresse;
    }

    public function setadresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
 * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="commande")
 */
private $achats;

}
