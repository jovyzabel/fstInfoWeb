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
            ->add('marriedName', TextType::class, [
                'label' => 'Nom d\'épouse (pour les femmes mariées)',
                'required' => false,
            ])
            ->add('nationality', CountryType::class, [
                'label' => 'Nationalité',
                'preferred_choices' => ['CG'],
            ])
            ->add('identificationDocument', IdentificationDocumentType::class)
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Etudiant' => 'Etudiant',
                    'Travailleur' => 'Travailleur',
                ]
            ])
            ->add('job', TextType::class, [
                'label' => 'Nom et adresse de votre entreprise',
                'required' => false,
            ])
            ->add('lastSchool', TextType::class, [
                'label' => 'Dernier Etablissement'
            ])
            ->add('lastDiploma', TextType::class, [
                'label' => 'Dernier Diplôme'
            ])
            ->add('address', AddressType::class, [
                'label' => 'Adresse'
            ])
            ->add('contactPerson', ContactPersonType::class, [
                'label' => 'Personne ressource qu\'on peut contacter'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
