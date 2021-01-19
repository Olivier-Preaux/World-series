<?php

namespace App\DataFixtures;

use App\Entity\Season;
use  Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{   
    public const SEASON_REFERENCE = 'Dead';

    public function getDependencies()  
    {
        return [ProgramFixtures::class];  
    }

    public function load(ObjectManager $manager)
    {   
        $j = 0 ;
        for ( $i=2010 ; $i <2020 ; $i++) {
            $j++;

            $faker  =  Faker\Factory::create('fr_FR');
            $season = new Season();

            $season->setYear($i);
            $season->setNumber($j);           
            $season->setDescription($faker->text(200));
            
            $season->setProgram($this->getReference(ProgramFixtures::PROGRAM_REFERENCE));

               
            $season->setNumber($j);
            
        
        
        
            $manager->persist($season);
        }
        
        $manager->flush();
        $this->addReference( self::SEASON_REFERENCE , $season);
    }
}