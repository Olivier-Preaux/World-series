<?php

namespace App\DataFixtures;

use App\Entity\User;
use  Faker;
use Faker\Factory;
use App\DataFixtures\CommentFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture 
{   
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {   
        $faker = Factory::create('fr_FR');
        $userReferenceNumber = 0;

        //Generate Women Users
        for ($i = 0; $i < 10; $i++) {
        // Création d’un utilisateur de type “contributeur” (= auteur)
        $contributor = new User();
        $contributor->setEmail($faker->email);
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $contributor->setUsername($faker->firstNameMale);
        $contributor->setBio($faker->sentence(20));
        $contributor->setPassword($this->passwordEncoder->encodePassword(
            $contributor,
            'contributorpassword'
        ));

        $manager->persist($contributor);
        $this->addReference('user' . $userReferenceNumber, $contributor);
            $userReferenceNumber++;
        }

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername($faker->firstNameMale);
        $admin->setBio($faker->sentence(20));
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);
        $this->addReference('admin', $admin );

        // Sauvegarde des 2 nouveaux utilisateurs :
        $manager->flush();
       
    }
}
