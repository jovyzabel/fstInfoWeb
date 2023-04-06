<?php

namespace App\Form;

use App\Form\FolderType;
use App\Entity\Speciality;
use App\Entity\PreRegistration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PreRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('student', StudentType::class,[
                'label'=>'Etudiant',
            ])
            ->add('speciality', EntityType::class, [
                'class' => Speciality::class,
                ])
            ->add('preRegistrationType', ChoiceType::class, [
                'choices' => ['Normale' => 'normale', 'Equivalence' => 'equivalence', 'Dérogation' => 'derogation'],
            ])
            ->add('folder', FolderType::class, [
                
                ])
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
