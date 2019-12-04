<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Common\Persistence\ObjectManager;

class ArtistFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // Générer 50 artistes
        $this->createMany(50,function (){
           // Construction du nom d'artiste
            $name = $this->faker->randomElement(['DJ','MC','Lil','']);
            $name .= $this->faker->firstName;
            $name .= $this->faker->randomElement([
               ' ' . $this->faker->realText(),
                ' aka ' . $this->faker->domainWord,
                ' & The ' . $this->faker->lastName,
                ''
            ]);

            // instaciation de l'entite
            $artist = (new Artist())
                ->setName($name)
                ->setDescription($this->faker->realText(50));

            // Retourner l'entite
            return $artist;
        });

        // Enregistrer les entités en BDD
        $manager->flush();
    }
}
