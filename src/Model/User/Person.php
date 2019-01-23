<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/2/2019 3:08 PM
 * Project: EncounterTheCross
 * File Name: Person.php
 */

namespace App\Model\User;

use App\Model\States;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

/**
 * Class Person
 *
 * This class contains extended details about a person.
 *
 * @package App\Model\User
 */
abstract class Person extends BasePerson
{

    /**
     * @ORM\Column(type="string", length=31)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/[\(\)0-9 - ext.]+/",
     *     match=true,
     *     message="[\(\)0-9 -ext.]+"
     * )
     */
    protected $phone;


    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=31)
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $zipcode;

    /**
     * @var States
     */
    private $states;

    /**
     * Address constructor.
     */
    public function __construct()
    {
        $this->states = new States();
    }


    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        if($this->states->checkState($state)){
            $this->state = $state;
        } else {
            throw new InvalidArgumentException;
        }
        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

}
