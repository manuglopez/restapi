<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class E_UsersFixtures extends Fixture implements UserPasswordHasherInterface
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
           'email' => 'mglopez@me.com',
            'plain_password' => 'manuel',
        ]);
        UserFactory::createMany(10);
    }
}
