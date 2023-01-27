<?php

namespace App\Form;

use App\Entity\PreRegistration;
use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('student', StudentType::class)
            ->add('speciality', EntityType::class, [
                'class' => Speciality::class,
                'preferred_choices' => ['CG']
                ])
            ->add('preRegistrationType', ChoiceType::class, [
                'choices' => ['Normale' => 'normale', 'Equivalence' => 'equivalence',],
            ])
            ->add('folder', FolderType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PreRegistration::class,
            'attr' => ['id' => 'preRegistrationForm']
        ]);
    }
}
