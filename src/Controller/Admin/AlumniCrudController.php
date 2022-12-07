<?php

namespace App\Controller\Admin;

use App\Entity\Alumni;
use App\Entity\Person;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AlumniCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alumni::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            TextField::new('firstName'),
            TextField::new('avatarFile')->setFormType(VichImageType::class)->onlyOnForms(),
            AssociationField::new('promotion'),
            TextField::new('profil'),
            TextareaField::new('testimonial'),
            ImageField::new('avatarName')
                ->setBasePath('/uploads/images/avatars')
                ->setUploadDir('/public/uploads/images/avatars')
                ->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm()
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Person) return;
        $entityInstance->setUpdatedAt(new DateTimeImmutable());
        parent::updateEntity($entityManager, $entityInstance);
    }

  
}
