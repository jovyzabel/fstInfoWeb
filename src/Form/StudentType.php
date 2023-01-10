<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pictureFile', VichImageType::class, [
                'required' => false,
            ])
            ->add('civility',ChoiceType::class, [
                'label'=> 'Civilité',
                'choices' => ['Monsieur' => 'M','Madame' => 'F',],
            ])
            ->add('birthDay', DateType::class, [
                "label" => "Date de Naissance",
                "widget" => "single_text"
            ])
            ->add('birthPlace')
            ->add('telephone')
            ->add('email')
            ->add('name')
            ->add('firstName')
            ->add('address', AddressType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
