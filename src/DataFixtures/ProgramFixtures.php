<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\User;
use App\Service\Slugify;
use App\DataFixtures\UserFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface{

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public const PROGRAM_REFERENCE = 'walking';
    
    public function getDependencies()  
    {
        return [CategoryFixtures::class , UserFixtures::class ];  
    }

    const PROGRAMS = [        
        'The Haunting Of Hill House' => [
                            'summary' => 'Plusieurs frères et sœurs qui, enfants, ont grandi dans la demeure qui allait devenir la maison hantée la plus célèbre des États-Unis, sont contraints de se réunir pour finalement affronter les fantômes de leur passé.',
                            'category' => 'categorie_4',
                            'poster' => 'https://m.media-amazon.com/images/M/MV5BMTU4NzA4MDEwNF5BMl5BanBnXkFtZTgwMTQxODYzNjM@._V1_SY1000_CR0,0,674,1000_AL_.jpg',
                            ],
        'American Horror Story' => [
                            'summary' => 'A chaque saison, son histoire. American Horror Story nous embarque dans des récits à la fois poignants et cauchemardesques, mêlant la peur, le gore et le politiquement correct.',
                            'category' => 'categorie_4',
                            'poster' => 'https://m.media-amazon.com/images/M/MV5BODZlYzc2ODYtYmQyZS00ZTM4LTk4ZDQtMTMyZDdhMDgzZTU0XkEyXkFqcGdeQXVyMzQ2MDI5NjU@._V1_SY1000_CR0,0,666,1000_AL_.jpg',
                            ],
        'Love Death And Robots' => [
                            'summary' => 'Un yaourt susceptible, des soldats lycanthropes, des robots déchaînés, des monstres-poubelles, des chasseurs de primes cyborgs, des araignées extraterrestres et des démons assoiffés de sang : tout ce beau monde est réuni dans 18 courts métrages animés déconseillés aux âmes sensibles.',
                            'category' => 'categorie_4',
                            'poster' => 'https://m.media-amazon.com/images/M/MV5BMTc1MjIyNDI3Nl5BMl5BanBnXkFtZTgwMjQ1OTI0NzM@._V1_SY1000_CR0,0,674,1000_AL_.jpg',
                            ],
        'Penny Dreadful' => [
                            'summary' => 'Dans le Londres ancien, Vanessa Ives, une jeune femme puissante aux pouvoirs hypnotiques, allie ses forces à celles de Ethan, un garçon rebelle et violent aux allures de cowboy, et de Sir Malcolm, un vieil homme riche aux ressources inépuisables. Ensemble, ils combattent un ennemi inconnu, presque invisible, qui ne semble pas humain et qui massacre la population.',
                            'category' => 'categorie_4',
                            'poster' => 'https://m.media-amazon.com/images/M/MV5BNmE5MDE0ZmMtY2I5Mi00Y2RjLWJlYjMtODkxODQ5OWY1ODdkXkEyXkFqcGdeQXVyNjU2NjA5NjM@._V1_SY1000_CR0,0,695,1000_AL_.jpg',
                            ],
        'Fear The Walking Dead' => [
                            'summary' => 'La série se déroule au tout début de l épidémie relatée dans la série mère The Walking Dead et se passe dans la ville de Los Angeles, et non à Atlanta. Madison est conseillère dans un lycée de Los Angeles. Depuis la mort de son mari, elle élève seule ses deux enfants : Alicia, excellente élève qui découvre les premiers émois amoureux, et son grand frère Nick qui a quitté la fac et a sombré dans la drogue.',
                            'category' => 'categorie_4',
                            'poster' => 'https://m.media-amazon.com/images/M/MV5BYWNmY2Y1NTgtYTExMS00NGUxLWIxYWQtMjU4MjNkZjZlZjQ3XkEyXkFqcGdeQXVyMzQ2MDI5NjU@._V1_SY1000_CR0,0,666,1000_AL_.jpg',
                            ],
        'Viking' => [
                            'summary' => 'Les exploits d\'un groupe de Vikings mené par Ragnar Lothbrok, l\un des vikings les plus populaires de son époque et au destin semi-légendaire, sont narrés par la série. Ragnar serait d\'origine norvégienne et suédoise, selon les sources. Il est supposé avoir unifié les clans vikings en un royaume aux frontières indéterminées à la fin du viiie siècle (le roi Ecbert mentionne avoir vécu à la cour du roi Charlemagne, sacré empereur en l\'an 800). Mais il est surtout connu pour avoir été le promoteur des tout premiers raids vikings en terres chrétiennes, qu\'elles soient saxonnes, franques ou celtiques.',
                            'category' => 'categorie_1',
                            'poster' => 'https://i.pinimg.com/originals/95/87/46/9587468e8f263cf46fdbb1e21e18918f.jpg'
                            ],
        'Le jeu de la Dame' => [
                            'summary' => 'En pleine Guerre froide, le parcours de huit à vingt-deux ans d\'une jeune orpheline prodige des échecs, Beth Harmon. Tout en luttant contre une addiction, elle va tout mettre en place pour devenir la plus grande joueuse d’échecs du monde.',
                            'category' => 'categorie_5',
                            'poster' => 'https://fr.web.img4.acsta.net/pictures/20/09/25/09/06/0492330.jpg'
                                ], 
        'Breaking Bad'=> [
                            'summary' => 'La série se concentre sur Walter White, un professeur de chimie surqualifié et père de famille, qui, ayant appris qu\'il est atteint d\'un cancer du poumon en phase terminale, sombre dans le crime pour assurer l\'avenir financier de sa famille. Pour cela, il se lance dans la fabrication et la vente de méthamphétamine avec l\'aide de l\'un de ses anciens élèves, Jesse Pinkman2. L\'histoire se déroule à Albuquerque, au Nouveau-Mexique.',
                            'category' => 'categorie_2',
                            'poster' => 'https://fr.web.img5.acsta.net/pictures/19/06/18/12/11/3956503.jpg'
                                        ],     
        'The Witcher'=> [
                            'summary' => 'Le sorceleur Geralt, un chasseur de monstres mutant, se bat pour trouver sa place dans un monde où les humains se révèlent souvent plus vicieux que les bêtes.',
                            'category' => 'categorie_4',
                            'poster' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSyN85JQSuwzb6AXatDSoCIkzN-GdNWKTegJ6q0pbC-0jNnoLoQ'
                                                        ],                                   
        'Walking Dead' => [
                            'summary' => 'Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',
                            'category' => 'categorie_4',
                            'poster' => 'https://m.media-amazon.com/images/M/MV5BZmFlMTA0MmUtNWVmOC00ZmE1LWFmMDYtZTJhYjJhNGVjYTU5XkEyXkFqcGdeQXVyMTAzMDM4MjM0._V1_.jpg',
                            ],
       
        ];  

    public function load(ObjectManager $manager)
    {   
        $i= 0 ;

        foreach (self::PROGRAMS as $programTitle => [ 'summary' => $programSummary , 'category' => $catégory , 'poster'=> $poster ] ){
            
           
            
            $program = new Program();
            $slugify = new Slugify();
            
            $program->setTitle($programTitle);
            $program->setSummary($programSummary);
            $program->setPoster($poster);
            $program->setOwner(($this->getReference('user'.$i )));
            $i++ ;
            $slug = $slugify->generate($program->getTitle() ?? '');
            $program->setSlug($slug);
            $program->setCategory($this->getReference('category_4'));
            $manager->persist($program);

           
            
            
        }
            $manager->flush() ;
            $this->addReference( self::PROGRAM_REFERENCE , $program);
            

    }



}