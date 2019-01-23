<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Repository\EventLocationRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends BaseFixture implements OrderedFixtureInterface
{

    /**
     * @var EventLocationRepository
     */
    private $eventLocationRepository;

    public function __construct(EventLocationRepository $eventLocationRepository)
    {
        $this->eventLocationRepository = $eventLocationRepository;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(2, 'events', function($i) {
            $event = new Event();
            $startdate = $this->faker->dateTimeThisYear();
            $location = $this->eventLocationRepository->findOneRandomly();
            $event
                ->setName($this->faker->randomElement(['Mens Encounter','Womens Encounter']))
                ->setStart($startdate)
                ->setEnd($startdate->add(new \DateInterval('P10D')))
                ->setLocation($location)
            ;

            return $event;
        });

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
