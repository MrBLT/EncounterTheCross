<?php

namespace App\DataFixtures;

use App\Entity\EventAttendee;
use App\Repository\EventRepository;
use App\Repository\LaunchPointRepository;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EventAttendeeFixtures extends BaseFixture implements OrderedFixtureInterface
{
    /**
     * @var EventRepository
     */
    private $eventRepository;
    /**
     * @var LaunchPointRepository
     */
    private $launchPointRepository;

    public function __construct(EventRepository $eventRepository, LaunchPointRepository $launchPointRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->launchPointRepository = $launchPointRepository;
    }

    public function loadData(ObjectManager $manager)
    {
        $events = $this->eventRepository->findAll();
        foreach ($events as $event){
            for ($i = 0; $i < 20; $i++) {
                $attendee = new EventAttendee();
                $attendee
                    ->setAddress($this->faker->address)
                    ->setCity($this->faker->city)
                    ->setState('KS')
                    ->setZipcode($this->faker->postcode)
                    ->setPhone($this->faker->phoneNumber)
                    ->setFirstName($this->faker->firstName)
                    ->setLastName($this->faker->lastName)
                    ->setEmail($this->faker->email)
                ;
                $attendee->setInvitedby($this->faker->name);
                $attendee->setChurch($this->faker->company);
                $attendee->setConcerns($this->faker->sentence());
                $attendee->setContactPersonRelationship('bro');
                $attendee->setContactPersonPhone($this->faker->phoneNumber);
                $attendee->setLaunchPoint($this->launchPointRepository->findOneRandomly());
                $attendee->setEvent($event);
                $attendee->setContactPerson($this->faker->firstName);
                $manager->persist($attendee);
            }
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
