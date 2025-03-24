<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventSituationApproachRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventSituationApproachRepository::class)]
#[ApiResource]
class EventSituationApproach
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private array $cost = [];

    #[ORM\ManyToOne(inversedBy: 'approaches')]
    private ?EventSituation $eventSituation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCost(): array
    {
        return $this->cost;
    }

    public function setCost(array $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getEventSituation(): ?EventSituation
    {
        return $this->eventSituation;
    }

    public function setEventSituation(?EventSituation $eventSituation): static
    {
        $this->eventSituation = $eventSituation;

        return $this;
    }
}
