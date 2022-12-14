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
            ->add('street_name', TextType::class,[
                'label' => 'Rue',
                'attr' => ['class' => 'rounded-0 sumup',
                    'placeholder' => 'Nom de la ruelle'],
            ])
            ->add('street_number', IntegerType::class,[
                'label' => 'Numero',
                'attr' => ['class' => 'rounded-0 sumup',]
            ])
            ->add('quater_name', TextType::class, [
                'label' => 'Quartier',
                'attr' => ['class' => 'rounded-0 sumup',
                    'placeholder' => 'Nom du quartier'],
                ])
                ->add('city',  TextType::class, [
                    'label' => 'Ville',
                    'attr' => ['class' => 'rounded-0 sumup',
                        'placeholder' => 'Nom de la ville de résidence'],
                
            ])
            ->add('country', CountryType::class,[
                'attr'=>['class' => 'rounded-0 sumup']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
