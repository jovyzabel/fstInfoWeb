<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pictureFile', VichImageType::class, [
                'label' => 'photo identité',
                'attr' => ['onchange' => 'showPreview(event)'],
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => "Vous ne pouvez inclure qu'un fichier png ou jpeg",
                    ])
                ],
            ])
            ->add('civility', ChoiceType::class, [
                'label' => 'Civilité',
                'choices' => ['Monsieur' => 'M', 'Madame' => 'F',],
            ])
            ->add('birthDay', DateType::class, [
                "label" => "Date de Naissance",
                "widget" => "single_text",
                'constraints' => [
                    new NotBlank(),
                    new LessThanOrEqual(['value' => '-15 years',]),
                ]
            ])

            ->add('birthPlace', TextType::class, [
                'label' => 'Lieu de Naissance'
            ])
            ->add('telephone')
            ->add('email', EmailType::class)
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('nationality', CountryType::class, [
                'label' => 'Nationalité'
            ])
            ->add('address', AddressType::class, [
                'label' => 'Adresse'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
