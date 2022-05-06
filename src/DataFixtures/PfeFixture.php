<?php

namespace App\DataFixtures;

use App\Entity\Pfe;
use App\Entity\Entreprise ;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PfeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        // $product = new Product();
        // $manager->persist($product);
        $repo = $manager->getRepository(Entreprise::class) ;
        $ents = $repo->findAll() ;

        for ($i = 0 ; $i < 100 ; $i++){

            $pfe = new Pfe();
            $pfe->setStudent($faker->name);
            $pfe->setTitle($faker->title);
            $pfe->setEntreprise($ents[
            $faker->numberBetween(0,sizeof($ents)-1)
            ]);
            $manager->persist($pfe);
        }
        $manager->flush();
    }

}
