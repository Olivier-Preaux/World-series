<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use  Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use phpDocumentor\Reflection\PseudoTypes\True_;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{   
    public function getDependencies()  
    {
        return [SeasonFixtures::class];  
    }

    public function load(ObjectManager $manager)
    {   
            for ( $i=1 ; $i <=12 ; $i++) {
            
            $faker  =  Faker\Factory::create('fr_FR');
            $episode = new Episode();
            
            $episode->setSynopsis($faker->text(200));
            
            $episode->setSeason($this->getReference(SeasonFixtures::SEASON_REFERENCE));

               
            $episode->setNumber($i);
            $episode->setTitle($faker->sentence(5, true));
            
        
        
        
            $manager->persist($episode);
        }
        
        $manager->flush();
    }
}