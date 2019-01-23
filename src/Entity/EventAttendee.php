<?php

namespace App\Entity;

use App\Model\User\PersonWithContact;
use App\Model\User\PersonWithPayment;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventAttendeeRepository")
 */
class EventAttendee extends PersonWithPayment
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

    /**
     * @ORM\Column(type="boolean")
     */
    private $checkedIn = false;

    public function getId()
    {
        return $this->id;
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

    public function getCheckedIn(): ?bool
    {
        return $this->checkedIn;
    }

    public function setCheckedIn(bool $checkedIn): self
    {
        $this->checkedIn = $checkedIn;

        return $this;
    }
}
