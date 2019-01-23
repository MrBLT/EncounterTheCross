<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestimonialRepository")
 */
class Testimonial
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
     * @ORM\Column(type="string", length=511)
     */
    private $testimony;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $allowedToPublish;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $recordDate;

    public function __construct()
    {
        $this->recordDate = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getRecordDate()
    {
        return $this->recordDate;
    }

    /**
     * @param mixed $recordDate
     */
    public function setRecordDate($recordDate): void
    {
        $this->recordDate = $recordDate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTestimony(): ?string
    {
        return $this->testimony;
    }

    public function setTestimony(string $testimony): self
    {
        $this->testimony = $testimony;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getAllowedToPublish(): ?bool
    {
        return $this->allowedToPublish;
    }

    public function setAllowedToPublish(bool $allowedToPublish): self
    {
        $this->allowedToPublish = $allowedToPublish;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
