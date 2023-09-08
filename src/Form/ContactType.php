<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre nom complet'], TextType::class, [
                    'label' => 'Série',
                    'constraints' => [
                        new NotBlank(null, 'Ce champs ne peux pas être null'),
                    ],
                ]
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Votre adresse email'], TextType::class, [
                    'label' => 'Série',
                    'constraints' => [
                        new NotBlank(null, 'Ce champs ne peux pas être null'),
                    ],
                ]
            ])
            ->add('object', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Objet du message'], TextType::class, [
                    'label' => 'Série',
                    'constraints' => [
                        new NotBlank(null, 'Ce champs ne peux pas être null'),
                    ],
                ]
            ])
            ->add('content', CKEditorType::class, [
                'label' => false,
                'config_name' => 'lite_config',
                'attr' => ['placeholder' => 'Contenu du message'],
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
