<?php

namespace App\DataFixtures;

use App\Entity\PFE;
use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PfeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 100; $i++) {
            $repo = $manager->getRepository(Entreprise::class) ;
            $rand = rand(2,40) ;
            $entreprise =   $repo->findOneBy(['id' => "$rand"]) ;
            $pfe = new PFE();

            $pfe->setTitle($faker->title);
            $pfe->setStudent($faker->name);
            $pfe->setEntreprise($entreprise);

            $manager->persist($pfe);
        }
        $manager->flush();
    }
}
