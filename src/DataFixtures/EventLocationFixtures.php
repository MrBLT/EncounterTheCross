<?php

namespace App\DataFixtures;

use App\Entity\EventLocation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EventLocationFixtures extends BaseFixture implements OrderedFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(5, 'event_location', function($i) {
            $location = new EventLocation();
            $location
                ->setName('Webster Conference Center'.$i)
                ->setAddress($this->getFakeAddressLine())
                ->setCity($this->faker->city)
                ->setState('KS')
                ->setZipcode($this->faker->postcode)
            ;
            return $location;
        });

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
