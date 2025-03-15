<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setUsername('jeremyy_prt');
        $user1->setEmail('jeremy@gmail.com');
        $user1->setPassword('password');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('melvinn_prt');
        $user2->setEmail('melvin@gmail.com');
        $user2->setPassword('password');
        $manager->persist($user2);

        $this->addReference('jeremyy_prt', $user1);
        $this->addReference('melvinn_prt', $user2);

        $manager->flush();
    }
}