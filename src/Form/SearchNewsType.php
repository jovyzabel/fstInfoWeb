<?php

namespace App\Form;

use App\Data\SearchNews;
use App\Entity\Category;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchNewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchText', TextType::class)
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'multiple' => true, 
                'expanded' => true
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'multiple' => true, 
                'expanded' => true
            ])
            ->add('minDate', DateType::class, [
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=> SearchNews::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    
}
