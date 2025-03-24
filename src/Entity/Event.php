<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ApiResource]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    /**
     * @var Collection<int, EventChoice>
     */
    #[ORM\OneToMany(targetEntity: EventChoice::class, mappedBy: 'baseEvent')]
    private Collection $eventChoices;

    /**
     * @var Collection<int, EventSituation>
     */
    #[ORM\OneToMany(targetEntity: EventSituation::class, mappedBy: 'baseEvent')]
    private Collection $eventSituations;

    public function __construct()
    {
        $this->eventChoices = new ArrayCollection();
        $this->eventSituations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, EventChoice>
     */
    public function getEventChoices(): Collection
    {
        return $this->eventChoices;
    }

    public function addEventChoice(EventChoice $eventChoice): static
    {
        if (!$this->eventChoices->contains($eventChoice)) {
            $this->eventChoices->add($eventChoice);
            $eventChoice->setBaseEvent($this);
        }

        return $this;
    }

    public function removeEventChoice(EventChoice $eventChoice): static
    {
        if ($this->eventChoices->removeElement($eventChoice)) {
            // set the owning side to null (unless already changed)
            if ($eventChoice->getBaseEvent() === $this) {
                $eventChoice->setBaseEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EventSituation>
     */
    public function getEventSituations(): Collection
    {
        return $this->eventSituations;
    }

    public function addEventSituation(EventSituation $eventSituation): static
    {
        if (!$this->eventSituations->contains($eventSituation)) {
            $this->eventSituations->add($eventSituation);
            $eventSituation->setBaseEvent($this);
        }

        return $this;
    }

    public function removeEventSituation(EventSituation $eventSituation): static
    {
        if ($this->eventSituations->removeElement($eventSituation)) {
            // set the owning side to null (unless already changed)
            if ($eventSituation->getBaseEvent() === $this) {
                $eventSituation->setBaseEvent(null);
            }
        }

        return $this;
    }
}
