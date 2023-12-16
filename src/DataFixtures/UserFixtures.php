<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Query\Expr\Func;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEndoder,
        private SluggerInterface $slugger
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // $admin = new User();
        // $admin->setEmail('admin@gmail.com');
        // $admin->setName('admin');
        // $admin->setPassword(
        //     $this->passwordEndoder->hashPassword($admin, 'admin')
        // );
        // $admin->setRoles(['ROLE_ADMIN']);
        // $manager->persist($admin);

        // $faker = Faker\Factory::create('fr_FR');
        // for ($i = 0; $i < 5; $i++) {
        //     $user = new User();
        //     $user->setEmail($faker->email);
        //     $user->setName($faker->name);
        //     $user->setPassword(
        //         $this->passwordEndoder->hashPassword($user, 'gerant')
        //     );
        //     $user->setRoles(['ROLE_GERANT']);
        //     $manager->persist($user);
        // }

        // $manager->flush();
    }
}