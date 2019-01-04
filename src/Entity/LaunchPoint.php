<?php

namespace App\Entity;

use App\Model\Location;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\LaunchPointRepository")
 */
class LaunchPoint extends Location
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventAttendee", mappedBy="launchPoint")
     */
    private $eventAttendees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventServer", mappedBy="launchPoint")
     */
    private $eventServers;

    public function __construct()
    {
        $this->eventAttendees = new ArrayCollection();
        $this->eventServers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    /**
     * @return Collection|EventAttendee[]
     */
    public function getEventAttendees(): Collection
    {
        return $this->eventAttendees;
    }

    public function addEventAttendee(EventAttendee $eventAttendee): self
    {
        if (!$this->eventAttendees->contains($eventAttendee)) {
            $this->eventAttendees[] = $eventAttendee;
            $eventAttendee->setLaunchPoint($this);
        }

        return $this;
    }

    public function removeEventAttendee(EventAttendee $eventAttendee): self
    {
        if ($this->eventAttendees->contains($eventAttendee)) {
            $this->eventAttendees->removeElement($eventAttendee);
            // set the owning side to null (unless already changed)
            if ($eventAttendee->getLaunchPoint() === $this) {
                $eventAttendee->setLaunchPoint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EventServer[]
     */
    public function getEventServers(): Collection
    {
        return $this->eventServers;
    }

    public function addEventServer(EventServer $eventServer): self
    {
        if (!$this->eventServers->contains($eventServer)) {
            $this->eventServers[] = $eventServer;
            $eventServer->setLaunchPoint($this);
        }

        return $this;
    }

    public function removeEventServer(EventServer $eventServer): self
    {
        if ($this->eventServers->contains($eventServer)) {
            $this->eventServers->removeElement($eventServer);
            // set the owning side to null (unless already changed)
            if ($eventServer->getLaunchPoint() === $this) {
                $eventServer->setLaunchPoint(null);
            }
        }

        return $this;
    }
}
