<?php

namespace App\Form;

use App\Entity\IdentificationDocument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class IdentificationDocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeOfDocument', ChoiceType::class, [
                'label' => 'Type de pièce',
                'choices' => [
                    'Carte Nationale d\'Identité' => 'CNI',
                    'Passeport' => 'Passeport',
                    'Permis de Conduire' => 'Permis',
                ]
            ])
            ->add('identificationNumber', TextType::class, [
                'label' => 'Numéro de la pièce',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('dateOfIssue', DateType::class, [
                'label' => 'Date d\'émission',
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('placeOfIssue', TextType::class, [
                'label' => 'Lieu d\'émission',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IdentificationDocument::class,
        ]);
    }
}
