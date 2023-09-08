<?php

namespace App\Form;

use App\Entity\ContactPerson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom(s) et Prénom(s)',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('job', TextType::class, [
                'label' => 'Proféssion'
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('relationLink', ChoiceType::class, [
                'label' => 'Lien',
                'choices' => [
                    'Père' => 'Père',
                    'Mère' => 'Mère',
                    'Tuteur' => 'Tuteur',
                    'Epoux(se)' => 'Epoux(se)'
                ],
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactPerson::class,
        ]);
    }
}
