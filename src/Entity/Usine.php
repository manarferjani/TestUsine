<?php

namespace App\Entity;

use App\Repository\UsineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsineRepository::class)]
class Usine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nbrTotal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateProduction = null;

    #[ORM\Column]
    private ?bool $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbrTotal(): ?int
    {
        return $this->nbrTotal;
    }

    public function setNbrTotal(int $nbrTotal): static
    {
        $this->nbrTotal = $nbrTotal;

        return $this;
    }

    public function getDateProduction(): ?\DateTime
    {
        return $this->dateProduction;
    }

    public function setDateProduction(\DateTime $dateProduction): static
    {
        $this->dateProduction = $dateProduction;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
