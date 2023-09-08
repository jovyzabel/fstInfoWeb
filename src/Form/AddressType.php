<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'class' => 'rounded-0 sumup',
                    'placeholder' => 'Votre adresse physique'
                ],
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                    new Regex('/\d/', 'Ce champs ne peux pas contenir de chiffre')
                ],
            ])
            ->add('city',  TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'rounded-0 sumup',
                    'placeholder' => 'Ville de résidence'
                ],
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                    new Regex('/\d/', 'Ce champs ne peux pas contenir de chiffre'),
                ],

            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays de résidence',
                'preferred_choices' => ['CG'],
                'attr' => ['class' => 'rounded-0 sumup'],
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                    new Country(),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
