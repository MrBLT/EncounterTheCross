<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/8/2019 8:57 AM
 * Project: EncounterTheCross
 * File Name: PersonWithContact.php
 */

namespace App\Model\User;

use Doctrine\ORM\Mapping as ORM;

abstract class PersonWithContact extends Person
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $contactPerson;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $contactPersonRelationship;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $contactPersonPhone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $church;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $invitedby;

    /**
     * @return mixed
     */
    public function getChurch()
    {
        return $this->church;
    }

    /**
     * @param mixed $church
     */
    public function setChurch($church): void
    {
        $this->church = $church;
    }

    /**
     * @return mixed
     */
    public function getInvitedby()
    {
        return $this->invitedby;
    }

    /**
     * @param mixed $invitedby
     */
    public function setInvitedby($invitedby): void
    {
        $this->invitedby = $invitedby;
    }

    /**
     * @return mixed
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * @param mixed $contactPerson
     */
    public function setContactPerson($contactPerson): void
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * @return mixed
     */
    public function getContactPersonRelationship()
    {
        return $this->contactPersonRelationship;
    }

    /**
     * @param mixed $contactPersonRelationship
     */
    public function setContactPersonRelationship($contactPersonRelationship): void
    {
        $this->contactPersonRelationship = $contactPersonRelationship;
    }

    /**
     * @return mixed
     */
    public function getContactPersonPhone()
    {
        return $this->contactPersonPhone;
    }

    /**
     * @param mixed $contactPersonPhone
     */
    public function setContactPersonPhone($contactPersonPhone): void
    {
        $this->contactPersonPhone = $contactPersonPhone;
    }
}
