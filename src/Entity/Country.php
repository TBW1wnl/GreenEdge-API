<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ApiResource]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Tile>
     */
    #[ORM\OneToMany(targetEntity: Tile::class, mappedBy: 'country')]
    private Collection $tiles;

    public function __construct()
    {
        $this->tiles = new ArrayCollection();
    }

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
            $tile->setCountry($this);
        }

        return $this;
    }

    public function removeTile(Tile $tile): static
    {
        if ($this->tiles->removeElement($tile)) {
            // set the owning side to null (unless already changed)
            if ($tile->getCountry() === $this) {
                $tile->setCountry(null);
            }
        }

        return $this;
    }
}
