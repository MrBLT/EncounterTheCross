<?php

namespace App\DataFixtures;

use App\Entity\Testimonial;
use Doctrine\Common\Persistence\ObjectManager;

class TestimonialFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(50, 'testimonials', function($i) {
            $testimonial = new Testimonial();
            $testimonial
                ->setTestimony($this->faker->paragraph)
                ->setFullName($this->faker->firstName.' '.$this->faker->lastName)
                ->setAllowedToPublish($this->faker->boolean(60))
                ->setRecordDate($this->faker->dateTimeThisCentury)
            ;

            return $testimonial;
        });

        $manager->flush();
    }
}
