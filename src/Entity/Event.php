<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventLocation", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventAttendee", mappedBy="event")
     */
    private $attendees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventServer", mappedBy="event")
     */
    private $servers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->attendees = new ArrayCollection();
        $this->servers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getLocation(): ?EventLocation
    {
        return $this->location;
    }

    public function setLocation(?EventLocation $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|EventAttendee[]
     */
    public function getAttendees(): Collection
    {
        return $this->attendees;
    }

    public function addAttendee(EventAttendee $attendee): self
    {
        if (!$this->attendees->contains($attendee)) {
            $this->attendees[] = $attendee;
            $attendee->setEvent($this);
        }

        return $this;
    }

    public function removeAttendee(EventAttendee $attendee): self
    {
        if ($this->attendees->contains($attendee)) {
            $this->attendees->removeElement($attendee);
            // set the owning side to null (unless already changed)
            if ($attendee->getEvent() === $this) {
                $attendee->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EventServer[]
     */
    public function getServers(): Collection
    {
        return $this->servers;
    }

    public function addServer(EventServer $server): self
    {
        if (!$this->servers->contains($server)) {
            $this->servers[] = $server;
            $server->setEvent($this);
        }

        return $this;
    }

    public function removeServer(EventServer $server): self
    {
        if ($this->servers->contains($server)) {
            $this->servers->removeElement($server);
            // set the owning side to null (unless already changed)
            if ($server->getEvent() === $this) {
                $server->setEvent(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->getName()
            .' : '
            .$this->getStart()->format("F j, Y, g:i a")
            .' - '
            .$this->getEnd()->format("F j, Y, g:i a")
            ;
    }
}
