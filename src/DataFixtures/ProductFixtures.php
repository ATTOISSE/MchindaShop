<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker; 

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 11; $i++) {
            $product = new Product();
            $product->setWording($faker->text(20));
            $product->setPrice($faker->numberBetween(1500,400000));
            $product->setQuantity($faker->numberBetween(15,30));
            $product->setThreshold($faker->numberBetween(15,30));
            $product->setDescription($faker->text(20));
            $product->setPath('/images/' . $faker->imageUrl(180, 200));

            $manager->persist($product);
        }

        $manager->flush();
    }
}