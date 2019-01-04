<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/2/2019 3:20 PM
 * Project: EncounterTheCross
 * File Name: BasePerson.php
 */

namespace App\Model\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BasePerson
 *
 * This class contains basic information about a person
 *
 * @package App\Model\User
 */
abstract class BasePerson
{
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;



    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

}
