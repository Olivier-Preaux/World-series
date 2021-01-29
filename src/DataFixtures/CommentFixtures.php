<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\DataFixtures\UserFixtures;
use  Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use phpDocumentor\Reflection\PseudoTypes\True_;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{   
    public function getDependencies()  
    {
        return [EpisodeFixtures::class , UserFixtures::class ] ; 
    }


    public function load(ObjectManager $manager)
    {
        for ( $i=1 ; $i <=6 ; $i++) {
            
            $faker  =  Faker\Factory::create('fr_FR');
            $comment = new Comment();           
            
            $comment->setComment($faker->text(200));
            
            $comment->setEpisode($this->getReference(EpisodeFixtures::EPISODE_REFERENCE));

               
            $comment->setRate($faker->numberBetween(0,5));
            $comment->setAuthor(($this->getReference('admin')));      

            $manager->persist($comment);
        }
        
        $manager->flush();
    }
}
