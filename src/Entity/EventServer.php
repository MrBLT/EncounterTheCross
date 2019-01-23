<?php

namespace App\Entity;

use App\Model\User\PersonWithContact;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventServerRepository")
 */
class EventServer extends PersonWithContact
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $dutiesPerformed;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $concerns;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="servers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LaunchPoint", inversedBy="eventServers")
     */
    private $launchPoint;

    public function getId()
    {
        return $this->id;
    }

    public function getDutiesPerformed(): ?string
    {
        return $this->dutiesPerformed;
    }

    public function setDutiesPerformed(?string $dutiesPerformed): self
    {
        $this->dutiesPerformed = $dutiesPerformed;

        return $this;
    }

    public function getConcerns(): ?string
    {
        return $this->concerns;
    }

    public function setConcerns(?string $concerns): self
    {
        $this->concerns = $concerns;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getLaunchPoint(): ?LaunchPoint
    {
        return $this->launchPoint;
    }

    public function setLaunchPoint(?LaunchPoint $launchPoint): self
    {
        $this->launchPoint = $launchPoint;

        return $this;
    }
}
