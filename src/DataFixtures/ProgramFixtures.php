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
                            'poster' => 'Haunting.jpg',
                            ],
        'American Horror Story' => [
                            'summary' => 'A chaque saison, son histoire. American Horror Story nous embarque dans des récits à la fois poignants et cauchemardesques, mêlant la peur, le gore et le politiquement correct.',
                            'category' => 'categorie_4',
                            'poster' => 'ahs.jpg',
                            ],
        'Love Death And Robots' => [
                            'summary' => 'Un yaourt susceptible, des soldats lycanthropes, des robots déchaînés, des monstres-poubelles, des chasseurs de primes cyborgs, des araignées extraterrestres et des démons assoiffés de sang : tout ce beau monde est réuni dans 18 courts métrages animés déconseillés aux âmes sensibles.',
                            'category' => 'categorie_4',
                            'poster' => 'Lovedeath.jpg',
                            ],
        'Game Of Throne' => [
                            'summary' => 'Sur le continent de Westeros, le roi Robert Baratheon gouverne le Royaume des Sept Couronnes depuis plus de dix-sept ans, à la suite de la rébellion qu\'il a menée contre le « roi fou » Aerys II Targaryen. Jon Arryn, époux de la sœur de Lady Catelyn Stark, Lady Arryn, son guide et principal conseiller, vient de s\'éteindre, et le roi part alors dans le nord du royaume demander à son vieil ami Eddard « Ned » Stark de remplacer leur regretté mentor au poste de Main du roi. Ned, seigneur suzerain du nord depuis Winterfell et de la maison Stark, est peu désireux de quitter ses terres. Mais il accepte à contre-cœur de partir pour la capitale Port-Réal avec ses deux filles, Sansa et Arya. ',
                            'category' => 'categorie_5',
                            'poster' => 'Got.jpg',
                            ],
        'Penny Dreadful' => [
                            'summary' => 'Dans le Londres ancien, Vanessa Ives, une jeune femme puissante aux pouvoirs hypnotiques, allie ses forces à celles de Ethan, un garçon rebelle et violent aux allures de cowboy, et de Sir Malcolm, un vieil homme riche aux ressources inépuisables. Ensemble, ils combattent un ennemi inconnu, presque invisible, qui ne semble pas humain et qui massacre la population.',
                            'category' => 'categorie_4',
                            'poster' => 'Penny.jpg',
                            ],
        'Fear The Walking Dead' => [
                            'summary' => 'La série se déroule au tout début de l épidémie relatée dans la série mère The Walking Dead et se passe dans la ville de Los Angeles, et non à Atlanta. Madison est conseillère dans un lycée de Los Angeles. Depuis la mort de son mari, elle élève seule ses deux enfants : Alicia, excellente élève qui découvre les premiers émois amoureux, et son grand frère Nick qui a quitté la fac et a sombré dans la drogue.',
                            'category' => 'categorie_4',
                            'poster' => 'Fear.jpg',
                            ],
        'Prison Break' => [
                            'summary' => 'Lincoln Burrows, un petit truand, est accusé à tort d\'avoir tué le frère de la vice-présidente des États-Unis. Condamné à mort, il est incarcéré dans le pénitencier d\'État de Fox River, dans l\'attente de son exécution. Son frère, Michael Scofield, un ingénieur surdoué convaincu de son innocence, va l\'aider à s\'évader avant la date fatidique. Pour cela, Michael se fait tatouer les plans de la prison sur le torse, les bras et le dos, puis il commet un braquage afin d\'y être incarcéré à son tour. Une fois emprisonné à Fox River, Michael va chercher à s\'évader en compagnie de son frère, à l\'aide des plans qu\'il s\'est fait tatouer sur le corps.',
                            'category' => 'categorie_5',
                            'poster' => 'Prison.jpg'
                            ],
        'Vikings' => [
                            'summary' => 'Les exploits d\'un groupe de Vikings mené par Ragnar Lothbrok, l\un des vikings les plus populaires de son époque et au destin semi-légendaire, sont narrés par la série. Ragnar serait d\'origine norvégienne et suédoise, selon les sources. Il est supposé avoir unifié les clans vikings en un royaume aux frontières indéterminées à la fin du viiie siècle (le roi Ecbert mentionne avoir vécu à la cour du roi Charlemagne, sacré empereur en l\'an 800). Mais il est surtout connu pour avoir été le promoteur des tout premiers raids vikings en terres chrétiennes, qu\'elles soient saxonnes, franques ou celtiques.',
                            'category' => 'categorie_5',
                            'poster' => 'Vikings.jpg'
                            ],                       
        'Le jeu de la Dame' => [
                            'summary' => 'En pleine Guerre froide, le parcours de huit à vingt-deux ans d\'une jeune orpheline prodige des échecs, Beth Harmon. Tout en luttant contre une addiction, elle va tout mettre en place pour devenir la plus grande joueuse d’échecs du monde.',
                            'category' => 'categorie_5',
                            'poster' => 'Jeu.jpg'
                                ], 
        'Breaking Bad'=> [
                            'summary' => 'La série se concentre sur Walter White, un professeur de chimie surqualifié et père de famille, qui, ayant appris qu\'il est atteint d\'un cancer du poumon en phase terminale, sombre dans le crime pour assurer l\'avenir financier de sa famille. Pour cela, il se lance dans la fabrication et la vente de méthamphétamine avec l\'aide de l\'un de ses anciens élèves, Jesse Pinkman2. L\'histoire se déroule à Albuquerque, au Nouveau-Mexique.',
                            'category' => 'categorie_5',
                            'poster' => 'Breaking.jpg'
                                        ],     
        'The Witcher'=> [
                            'summary' => 'Le sorceleur Geralt, un chasseur de monstres mutant, se bat pour trouver sa place dans un monde où les humains se révèlent souvent plus vicieux que les bêtes.',
                            'category' => 'categorie_1',
                            'poster' => 'Witcher.jpg'
                                                        ],                                   
        'Walking Dead' => [
                            'summary' => 'Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',
                            'category' => 'categorie_4',
                            'poster' => 'Walking.jpg',
                            ],
       
        ];  

    public function load(ObjectManager $manager)
    {   
        $i= 0 ;

        foreach (self::PROGRAMS as $programTitle => [ 'summary' => $programSummary , 'category' => $categoryName , 'poster'=> $poster ] ){
            
           
            
            $program = new Program();
            $slugify = new Slugify();
            
            $program->setTitle($programTitle);
            $program->setSummary($programSummary);
            $program->setPoster($poster);
            $program->setOwner(($this->getReference('user'.$i )));
            $i++ ;
            $slug = $slugify->generate($program->getTitle() ?? '');
            $program->setSlug($slug);
            $program->setUpdatedAt(new \DateTime(date('Y-m-d H:i:s')));
            $program->setCategory($this->getReference($categoryName));
            $manager->persist($program);

           
            
            
        }
            $manager->flush() ;
            $this->addReference( self::PROGRAM_REFERENCE , $program);
            

    }



}