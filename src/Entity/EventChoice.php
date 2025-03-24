<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventChoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventChoiceRepository::class)]
#[ApiResource]
class EventChoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?array $effect = null;

    #[ORM\ManyToOne(inversedBy: 'eventChoices')]
    private ?Event $baseEvent = null;

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

    public function getEffect(): ?array
    {
        return $this->effect;
    }

    public function setEffect(?array $effect): static
    {
        $this->effect = $effect;

        return $this;
    }

    public function getBaseEvent(): ?Event
    {
        return $this->baseEvent;
    }

    public function setBaseEvent(?Event $baseEvent): static
    {
        $this->baseEvent = $baseEvent;

        return $this;
    }
}
