<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tag;
use App\Entity\Account;
use App\Entity\Article;
use App\Entity\Category;
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
                
                
                $manager->persist($article);

                $tag = new Tag();
                $tag->setLabel("Tag ".$i);
                $tag->setArticle($article);

    
                $manager->persist($tag);
                
            }
        }

        
        

        $manager->flush();
    }
}
