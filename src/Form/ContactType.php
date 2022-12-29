<?php

namespace App\Form;

use App\Entity\Contact;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez votre nom complet']
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Votre adresse email']
            ])
            ->add('object', TextType::class, [
                'label' => false,
                'attr' => [ 'placeholder' => 'Objet du message']
        ])
            ->add('content', CKEditorType::class, [
                'label' => false,
                'config_name' => 'lite_config',
                'attr' => [ 'placeholder' => 'Contenu du message']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
