<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WorldMapRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorldMapRepository::class)]
#[ApiResource]
class WorldMap
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $funds = null;

    /**
     * @var Collection<int, Tile>
     */
    #[ORM\OneToMany(targetEntity: Tile::class, mappedBy: 'map', orphanRemoval: true)]
    private Collection $tiles;

    #[ORM\ManyToOne(inversedBy: 'worldMaps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $player = null;

    public function __construct()
    {
        $this->tiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFunds(): ?int
    {
        return $this->funds;
    }

    public function setFunds(int $funds): static
    {
        $this->funds = $funds;

        return $this;
    }

    /**
     * @return Collection<int, Tile>
     */
    public function getTiles(): Collection
    {
        return $this->tiles;
    }

    public function addTile(Tile $tile): static
    {
        if (!$this->tiles->contains($tile)) {
            $this->tiles->add($tile);
            $tile->setMap($this);
        }

        return $this;
    }

    public function removeTile(Tile $tile): static
    {
        if ($this->tiles->removeElement($tile)) {
            // set the owning side to null (unless already changed)
            if ($tile->getMap() === $this) {
                $tile->setMap(null);
            }
        }

        return $this;
    }

    public function getPlayer(): ?User
    {
        return $this->player;
    }

    public function setPlayer(?User $player): static
    {
        $this->player = $player;

        return $this;
    }
}
