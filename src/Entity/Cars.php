<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarsRepository::class)]
class Cars
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $modèle = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collections $collections = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

  

    public function __construct()
    {
        $this->showrooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModèle(): ?string
    {
        return $this->modèle;
    }

    public function setModèle(string $modèle): static
    {
        $this->modèle = $modèle;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCollections(): ?Collections
    {
        return $this->collections;
    }

    public function setCollections(?Collections $collections): static
    {
        $this->collections = $collections;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    
}
