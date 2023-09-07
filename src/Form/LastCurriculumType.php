<?php

namespace App\Form;

use App\Entity\LastCurriculum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LastCurriculumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('semesterOneValidationYear')
            ->add('semesterOneAverage')
            ->add('school')
            ->add('semesterOneValidationSession')
            ->add('semesterTwoValidationSession')
            ->add('semesterTwoAverage')
            ->add('semesterTwoValidationYear')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LastCurriculum::class,
        ]);
    }
}
