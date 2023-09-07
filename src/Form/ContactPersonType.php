<?php

namespace App\Form;

use App\Entity\ContactPerson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom(s) et Prénom(s)'
            ])
            ->add('job', TextType::class, [
                'label' => 'Proféssion'
            ])
            ->add('telephone')
            ->add('relationLink', ChoiceType::class, [
                'label' => 'Lien',
                'choices' => [
                    'Père' => 'Père',
                    'Mère' => 'Mère',
                    'Tuteur' => 'Tuteur',
                    'Epoux(se)' => 'Epoux(se)'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactPerson::class,
        ]);
    }
}
