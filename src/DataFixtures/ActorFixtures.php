<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{  
    public function getDependencies()  
    {
        return [ProgramFixtures::class];  
    }

    const ACTORS = [
        'Andrey Lincoln',
        'Noman Reedus',
        'Lauren Cohan',
        'Danai Gurira',
        'Anya Taylor-Joy ',
    ] ;

    public function load(ObjectManager $manager)
    {   
        foreach (self::ACTORS as $key=> $actorName){
            $actor = new Actor();
            $actor->setName($actorName);
            
            $actor->addProgram($this->getReference(ProgramFixtures::PROGRAM_REFERENCE));   
            
            $manager->persist($actor);
        }
            $manager->flush() ;
    }

}