<?php

namespace App\Form;

use App\Entity\BaccalaureatDiploma;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;

class BaccalaureatDiplomaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('serie', TextType::class, [
                'label' => 'Série',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('titled', TextType::class, [
                'label' => 'Intitulé',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('year', TextType::class, [
                'label' => 'Année d\'obtention',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ])
            ->add('placeOfAcquisition', TextType::class, [
                'label' => 'Lycée (Ville/Pays)',
                'constraints' => [
                    new NotBlank(null, 'Ce champs ne peux pas être null'),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BaccalaureatDiploma::class,
        ]);
    }
}
