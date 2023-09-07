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
            ])
            ->add('city',  TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'rounded-0 sumup',
                    'placeholder' => 'Ville de résidence'
                ],

            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays de résidence',
                'preferred_choices' => ['CG'],
                'attr' => ['class' => 'rounded-0 sumup']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
