<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use  Faker;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use phpDocumentor\Reflection\PseudoTypes\True_;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{     
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function getDependencies()  
    {
        return [SeasonFixtures::class];  
    }

    public function load(ObjectManager $manager)
    {   
            for ( $i=1 ; $i <=12 ; $i++) {
            
            $faker  =  Faker\Factory::create('fr_FR');
            $episode = new Episode();
            $slugify = new Slugify();
            
            $episode->setSynopsis($faker->text(200));
            
            $episode->setSeason($this->getReference(SeasonFixtures::SEASON_REFERENCE));

               
            $episode->setNumber($i);
            $episode->setTitle($faker->sentence(5, true));
            $slug = $slugify->generate($episode->getTitle() ?? '');
            $episode->setSlug($slug);
            
        
        
        
            $manager->persist($episode);
        }
        
        $manager->flush();
    }
}