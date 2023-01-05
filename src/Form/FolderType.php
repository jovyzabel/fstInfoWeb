<?php

namespace App\Form;

use App\Entity\Folder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('attestationOfValidationFile', FileType::class, [
                'label' => 'Attestion de validation L1 ou Equivalent',
                'attr' => ['class' => 'rounded-0 sumup bg-light',
                            'placeholder' => 'Choisissez un fichier pdf',
                            'id' => 'attestation'],
                'mapped' => false,
                'required' => true,
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '2048k',
                //         'mimeTypes' => [
                //             'application/pdf',
                //             'application/x-pdf'
                //         ],
                //         'mimeTypesMessage' => "Vous ne pouvez inclure qu'un fichier pdf",
                //     ])
                // ],
            ])
            
            ->add('degreeFile',FileType::class, [
                'label' => 'Dernier diplome obtenu',
                'attr'=>['class' => 'rounded-0 sumup bg-light'],
                'mapped' => false,
                'required' => false,
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '2048k',
                //         'mimeTypes' => [
                //             'application/pdf',
                //             'application/x-pdf'
                //         ],
                //         'mimeTypesMessage' => "Vous ne pouvez inclure qu'un fichier pdf",
                //     ])
                // ],
            ])
            ->add('bulletinFile',FileType::class, [
                'label' => 'Relevés de notes',
                'attr'=>['class' => 'rounded-0 sumup bg-light'],
                'mapped' => false,
                'required' => false,
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '2048k',
                //         'mimeTypes' => [
                //             'application/pdf',
                //             'application/x-pdf'
                //         ],
                //         'mimeTypesMessage' => "Vous ne pouvez inclure qu'un fichier pdf",
                //     ])
                // ],
            ])
            ->add('letter',TextareaType::class, [
                'attr' => ['rows' => '5',
                           'class' => 'rounded-0 sumup' 
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Folder::class,
        ]);
    }
}
