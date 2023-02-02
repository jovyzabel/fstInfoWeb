<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\UE;
use Faker\Factory;
use App\Entity\Tag;
use DateTimeImmutable;
use App\Entity\Account;
use App\Entity\Article;
use App\Entity\Subject;
use App\Entity\Teacher;
use App\Entity\Category;
use App\Entity\Semester;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        $account = new Account();
        $account->setEmail("yolsern@gmail.com")
            ->setPassword($this->hasher
            ->hashPassword($account,'thiago'))
            ->setRoles(['ROLE_ADMIN']);
        
        $manager->persist($account);

        for ($j=0; $j < 3 ; $j++) { 
            $category = new Category();
            $category->setLabel("Categorie ".$j);

            $manager->persist($category);

            
            for ($i=0; $i < 20 ; $i++) { 
                $article = new Article();
                $article->setTitle($faker->sentence());
                $article->setContent($faker->paragraphs(3, true));
                $article->setAccount($account);
                $article->addCategory($category);

                $article->setCreatedAt(new DateTimeImmutable());


                $manager->persist($article);
                
                $tag = new Tag();
                $tag->setLabel("Tag ".$i);
                $tag->addArticle($article);

                $manager->persist($tag);
    
            }
        }

        for ($j=0; $j < 3; $j++) { 
            
            $teacher = new Teacher();
            $teacher
                ->setDiploma("Docteur en informatique")
                ->setCreatedAt(new DateTimeImmutable())
                ->setCivility('Monsieur')
                ->setPictureName($faker->imageUrl)
                ->setGrade("Assistant")
                ->setName($faker->lastName())
                ->setFirstName($faker->firstName());
            
            $manager->persist($teacher);
        }
        // for($n=1; $n<5; $n++ ) {

        //     $semester = new Semester();
        //     $semester->setCode('S'.$n);
            
    
        //     for ($i=0; $i < 3; $i++) { 
                
        //         $ue = new UE();
        //         $ue->setLabel("Unité d'enseignement - ".$i)
        //             ->setCode('UE'.$i.$n);
    
                    
        //             $ue->addSubject($subject);
                    
        //         }
        //         $manager->persist($ue);

        //         $semester->addUe($ue);
        //     }

        //     $manager->persist($semester);        
        // }


        $manager->flush();
    }
}
