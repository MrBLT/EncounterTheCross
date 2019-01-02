<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;


    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(5, 'report_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('reporter%d@etc.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'etc'
            ));

            return $user;
        });

        $this->createMany(5, 'admin_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@etc.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setLastName($this->faker->lastName);
            $user->setRoles(['ROLE_ADMIN']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'etc'
            ));

            return $user;
        });

        $manager->flush();
    }
}
