<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TileRepository::class)]
#[ApiResource]
class Tile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $population = null;

    #[ORM\Column]
    private ?bool $isOwned = null;

    #[ORM\ManyToOne(inversedBy: 'tiles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WorldMap $map = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): static
    {
        $this->population = $population;

        return $this;
    }

    public function isOwned(): ?bool
    {
        return $this->isOwned;
    }

    public function setOwned(bool $isOwned): static
    {
        $this->isOwned = $isOwned;

        return $this;
    }

    public function getMap(): ?WorldMap
    {
        return $this->map;
    }

    public function setMap(?WorldMap $map): static
    {
        $this->map = $map;

        return $this;
    }
}
