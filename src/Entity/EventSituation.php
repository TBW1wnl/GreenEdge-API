<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventSituationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventSituationRepository::class)]
#[ApiResource]
class EventSituation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $progress = null;

    #[ORM\Column]
    private ?int $defaut_progress = null;

    #[ORM\Column]
    private ?int $max_progress = null;

    #[ORM\Column]
    private array $effect = [];

    #[ORM\ManyToOne(inversedBy: 'eventSituations')]
    private ?Event $baseEvent = null;

    /**
     * @var Collection<int, EventSituationApproach>
     */
    #[ORM\OneToMany(targetEntity: EventSituationApproach::class, mappedBy: 'eventSituation')]
    private Collection $approaches;

    #[ORM\Column(nullable: true)]
    private ?int $deadLine = null;

    public function __construct()
    {
        $this->approaches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgress(): ?int
    {
        return $this->progress;
    }

    public function setProgress(int $progress): static
    {
        $this->progress = $progress;

        return $this;
    }

    public function getDefautProgress(): ?int
    {
        return $this->defaut_progress;
    }

    public function setDefautProgress(int $defaut_progress): static
    {
        $this->defaut_progress = $defaut_progress;

        return $this;
    }

    public function getMaxProgress(): ?int
    {
        return $this->max_progress;
    }

    public function setMaxProgress(int $max_progress): static
    {
        $this->max_progress = $max_progress;

        return $this;
    }

    public function getEffect(): array
    {
        return $this->effect;
    }

    public function setEffect(array $effect): static
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

    /**
     * @return Collection<int, EventSituationApproach>
     */
    public function getApproaches(): Collection
    {
        return $this->approaches;
    }

    public function addApproach(EventSituationApproach $approach): static
    {
        if (!$this->approaches->contains($approach)) {
            $this->approaches->add($approach);
            $approach->setEventSituation($this);
        }

        return $this;
    }

    public function removeApproach(EventSituationApproach $approach): static
    {
        if ($this->approaches->removeElement($approach)) {
            // set the owning side to null (unless already changed)
            if ($approach->getEventSituation() === $this) {
                $approach->setEventSituation(null);
            }
        }

        return $this;
    }

    public function getDeadLine(): ?int
    {
        return $this->deadLine;
    }

    public function setDeadLine(?int $deadLine): static
    {
        $this->deadLine = $deadLine;

        return $this;
    }
}
