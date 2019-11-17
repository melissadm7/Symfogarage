<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        for($i=1 ; $i <=10; $i++){
            $voiture = new Voiture();

            $marque = $faker-> randomElement($array = array ('Volvo','Citroen','Hyundai','BMW','Audi','Ford','KIA'));
            $modele = $faker->word();
            $imageCover = $faker->imageUrl(1000,300);
            $cylindre = $faker->word();
            $puissance = $faker->word();
            $carburant = $faker->word();
            $annee = $faker->date();
            $transmission = $faker->word();
            $description =  $faker->paragraph(3);
            $voption = $faker->paragraph(2);
            

            $voiture->setMarque($marque)
                    ->setModele($modele)
                    ->setImageCover($imageCover)
                    ->setKm(mt_rand(50,9999))
                    ->setPrix(mt_rand(3000,9999))
                    ->setProprio(mt_rand(1,3))
                    ->setCylindre($cylindre)
                    ->setPuissance($puissance)
                    ->setCarburant($carburant)
                    ->setAnnee($annee)
                    ->setTransmission($transmission)
                    ->setDescription($description)
                    ->setVoption($voption);

        $manager->persist($voiture);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}