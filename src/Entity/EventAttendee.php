<?php

namespace App\Entity;

use App\Model\User\Person;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventAttendeeRepository")
 */
class EventAttendee extends Person
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
    private $contactPerson;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contactPersonRelationship;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contactPersonPhone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $church;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $invitedby;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $questionsOrComments;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $concerns;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="attendees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LaunchPoint", inversedBy="eventAttendees")
     */
    private $launchPoint;

    public function getId()
    {
        return $this->id;
    }

    public function getContactPersonRelationship()
    {
        return $this->contactPersonRelationship;
    }

    public function setContactPersonRelationship($contactPersonRelationship): void
    {
        $this->contactPersonRelationship = $contactPersonRelationship;
    }

    public function getContactPersonPhone()
    {
        return $this->contactPersonPhone;
    }

    public function setContactPersonPhone($contactPersonPhone): void
    {
        $this->contactPersonPhone = $contactPersonPhone;
    }

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function setContactPerson(string $contactPerson): self
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    public function getChurch(): ?string
    {
        return $this->church;
    }

    public function setChurch(string $church): self
    {
        $this->church = $church;

        return $this;
    }

    public function getInvitedby(): ?string
    {
        return $this->invitedby;
    }

    public function setInvitedby(string $invitedby): self
    {
        $this->invitedby = $invitedby;

        return $this;
    }

    public function getQuestionsOrComments(): ?string
    {
        return $this->questionsOrComments;
    }

    public function setQuestionsOrComments(?string $questionsOrComments): self
    {
        $this->questionsOrComments = $questionsOrComments;

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
