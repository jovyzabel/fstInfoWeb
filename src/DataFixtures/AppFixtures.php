<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tag;
use App\Entity\Account;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Subject;
use App\Entity\Teacher;
use App\Entity\UE;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use PHPUnit\Util\Test;
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
        $account->setEmail("yolsern@gmail.com");
        $account->setPassword($this->hasher->hashPassword($account,'thiago'));
        
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
                $tag->setArticle($article);

    
                $manager->persist($tag);
                
            }
        }

        $level = ['L2', 'L3'];

        for ($i=0; $i < 3; $i++) { 
            
            $ue = new UE();
            $ue->setLabel("Unité d'enseignement - ".$i);

            for ($j=0; $j < 3; $j++) { 
                $subject = new Subject();
                $subject->setLabel('matiere - '.$j)
                    ->setDescription($faker->paragraph())
                    ->setLevel($level[array_rand($level)]);

                $manager->persist($subject);
                
                $teacher = new Teacher();
                $teacher->setDiploma("Docteur en informatique")
                    ->setPlaceOfAcquisition("FST - UMNG, Brazzaville")
                    ->setName($faker->lastName())
                    ->setFirstName($faker->firstName())
                    ->addTeachedSubject($subject);
                
                $manager->persist($teacher);
                
                $ue->addSubject($subject);
                
            }
            $manager->persist($ue);
        }

        
        

        $manager->flush();
    }
}
