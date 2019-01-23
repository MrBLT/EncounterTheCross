<?php

namespace App\DataFixtures;

use App\Entity\EventServer;
use App\Repository\EventRepository;
use App\Repository\LaunchPointRepository;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EventServerFixtures extends BaseFixture implements OrderedFixtureInterface
{
    /**
     * @var EventRepository
     */
    private $eventRepository;
    /**
     * @var LaunchPointRepository
     */
    private $launchPointRepository;

    public function __construct(EventRepository $eventRepository,LaunchPointRepository $launchPointRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->launchPointRepository = $launchPointRepository;
    }

    public function loadData(ObjectManager $manager)
    {
        $events = $this->eventRepository->findAll();
        foreach ($events as $event){
            for ($i = 0; $i < 20; $i++) {
                $server = new EventServer();
                $server
                    ->setAddress($this->getFakeAddressLine())
                    ->setCity($this->faker->city)
                    ->setState('KS')
                    ->setZipcode($this->faker->postcode)
                    ->setPhone($this->faker->phoneNumber)
                    ->setFirstName($this->faker->firstName)
                    ->setLastName($this->faker->lastName)
                    ->setEmail($this->faker->email)
                ;
                $server->setInvitedby($this->faker->name);
                $server->setChurch($this->faker->company);
                $server->setConcerns($this->faker->sentence());
                $server->setDutiesPerformed($this->faker->sentence());
                $server->setLaunchPoint($this->launchPointRepository->findOneRandomly());
                $server->setEvent($event);
                $server->setContactPerson($this->faker->firstName);
                $server->setContactPersonRelationship($this->faker->randomElement(['Spouse','Parent','Other Family','Friend']));
                $server->setContactPersonPhone($this->faker->phoneNumber);
                $manager->persist($server);
            }
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }


}
