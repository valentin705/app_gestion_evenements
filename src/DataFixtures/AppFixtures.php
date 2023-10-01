<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Event;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Predefined titles and descriptions for a more natural rendering
        $eventDetails = [
            "Fête de la musique" => "Venez célébrer la fête de la musique avec nous !",
            "Exposition d'art contemporain" => "Découvrez les œuvres des artistes contemporains de la région.",
            "Conférence sur la technologie" => "Participez à notre conférence sur les dernières innovations technologiques.",
            "Atelier de cuisine française" => "Apprenez à cuisiner des plats français traditionnels avec notre chef expérimenté.",
            "Tournoi de football local" => "Rejoignez-nous pour un tournoi amical de football.",
            "Séminaire sur l'environnement" => "Un séminaire pour discuter des enjeux environnementaux actuels.",
            "Festival du film français" => "Venez voir les meilleurs films français de l'année.",
            "Rencontre littéraire" => "Rencontrez vos auteurs préférés et découvrez de nouveaux livres.",
            "Journée portes ouvertes" => "Découvrez nos locaux et rencontrez notre équipe lors de notre journée portes ouvertes.",
            "Concert de jazz en plein air" => "Profitez d'une soirée agréable avec du jazz en direct."
        ];
    
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setEmail($faker->unique()->email)
                 ->setUsername($faker->unique()->userName)
                 ->setPassword($faker->password)
                 ->setRoles(['ROLE_USER']);
    
            $manager->persist($user);
    
            for ($j = 0; $j < 5; $j++) {
                $event = new Event();
                $startDate = $faker->dateTimeBetween('-1 years', 'now');
                $endDate = $faker->dateTimeBetween($startDate, '+2 years');
    
                // Random selection of a title and its corresponding description
                $randomEventDetail = $faker->randomElement(array_keys($eventDetails));
                $eventTitle = $randomEventDetail;
                $eventDescription = $eventDetails[$randomEventDetail];
    
                $event->setTitle($eventTitle)
                      ->setDescription($eventDescription)
                      ->setStartDateTime($startDate)
                      ->setEndDateTime($endDate)
                      ->setUser($user);
    
                $manager->persist($event);
            }
        }
    
        $manager->flush();
    
    }

}
