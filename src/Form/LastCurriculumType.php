<?php

namespace App\Form;

use App\Entity\LastCurriculum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;

class LastCurriculumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Intitulé',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('semesterOneValidationYear', TextType::class, [
                'label' => 'Année de validation S1',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                    new Length(4),
                    new Regex('^[0-9]+$', 'Ce champs ne doit contenir que des chiffres')
                ],
            ])
            ->add('semesterOneAverage', NumberType::class, [
                'label' => 'Moyenne S1',
                'constraints' => [
                    new Positive(),
                    new NotBlank(),
                ]
            ])
            ->add('school', TextType::class, [
                'label' => 'Etablissement',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                    new Regex('/\d/', 'Ce champs ne doit pas contenir de chiffre')
                ],
            ])
            ->add('semesterOneValidationSession', TextType::class, [
                'label' => 'Session de validation du S1',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                    new Regex('/\d/', 'Ce champs ne doit pas contenir de chiffre')
                ],
            ])
            ->add('semesterTwoValidationSession', TextType::class, [
                'label' => 'Session de validation du S2',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                    new Regex('/\d/', 'Ce champs ne doit pas contenir de chiffre')
                ],
            ])
            ->add('semesterTwoAverage', NumberType::class, [
                'label' => 'Moyenne S2',
                'constraints' => [
                    new Positive(),
                    new NotBlank(),
                ]
            ])
            ->add('semesterTwoValidationYear', TextType::class, [
                'label' => 'Année de validation S2',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                    new Length(4),
                    new Regex('^[0-9]+$', 'Ce champs ne doit contenir que des chiffres')
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LastCurriculum::class,
        ]);
    }
}
