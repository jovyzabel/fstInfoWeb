<?php

namespace App\Form;

use App\Entity\Student;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom",
                'attr' => ['id'=>'name','class'=>'rounded-0 sumup',
                    'placeholder' => 'Entrez votre nom de famille ici',
                    'id'=> 'lname'],
            ])
            ->add('firstName' , TextType::class, [
                "label" => "Prénom",
                'attr' => ['class'=>'rounded-0 sumup',
                    'placeholder' => 'Entrez votre prenom ici',
                    'id'=> 'fname'],
            ])
            ->add('civility', ChoiceType::class, [
                'attr'=> ['class'=>'rounded-0 sumup'],
                'label'=> 'Civilité',
                'choices' => [
                    'Monsieur' => 1,
                    'Madame' => 2,
                ],
                
            ])
            ->add('birthDay',DateType::class, [
                "attr"=> ['class'=>'rounded-0 sumup'],
                "label" => "Date de Naissance",
                "widget" => "single_text"
            ])
            ->add('birthPlace', TextType::class, [
                "label" => "Lieu de naissance",
                'attr' => ['class'=>'rounded-0 sumup',
                    'placeholder' => 'Entrez votre ville de naissance ici'],
            ])
            ->add('telephone', TelType::class, [
                'attr' => ['class'=>'rounded-0 sumup',
                    'placeholder' => 'Entrez un numéro à 9 chiffres ici'],
            ])  
            ->add('email', EmailType::class,
            [
                'attr' => ['class'=>'rounded-0 sumup',
                    'placeholder' => 'Entrez votre adresse email ici'],
            ])
            ->add('address', AddressType::class)
            ->add('avatarFile', FileType::class, [
                'label' => 'Avatar',
                'mapped' => false,
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
                'attr' => ['class'=>'rounded-0 sumup bg-secondary','id' => 'file-ip-1', 'onchange'=>'showPreview(event)'],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
