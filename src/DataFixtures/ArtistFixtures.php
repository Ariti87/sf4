<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0;$i<=50;$i++){
            $artist =(new Artist())
                ->setName('John Doe n°' . $i)
                ->setDescription('Test des fixtures');

            $manager->persist($artist);
        }

        $manager->flush();
    }
}
