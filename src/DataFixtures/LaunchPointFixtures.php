<?php

namespace App\DataFixtures;

use App\Entity\LaunchPoint;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LaunchPointFixtures extends BaseFixture implements OrderedFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(5, 'launch_points', function($i) {
            $launchPoint = new LaunchPoint();
            $launchPoint
                ->setName($this->faker->name)
                ->setAddress($this->getFakeAddressLine())
                ->setCity($this->faker->city)
                ->setState('KS')
                ->setZipcode($this->faker->postcode)
            ;
            return $launchPoint;
        });

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
