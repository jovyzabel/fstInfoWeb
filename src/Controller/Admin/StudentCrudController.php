<?php

namespace App\Controller\Admin;

use App\Entity\Person;
use App\Entity\Student;
use App\Form\StudentType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class StudentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Student::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('pictureFile')->setFormType(VichFileType::class)->onlyOnForms(),
            ImageField::new('pictureName')->setBasePath('/uploads/images/avatars')->setUploadDir('public/uploads/images/avatars')->hideOnForm(),
            TextField::new('name', 'Nom(s)'),
            TextField::new('firstName', 'Prénom(s)'),
            TextField::new('marriedName', 'Nom d\'épouse'),
            DateField::new('birthDay', 'Date de naissance'),
            TextField::new('birthPlace', 'Lieu de naissance'),
            TextField::new('civility', 'Civilité'),
            CountryField::new('nationality', 'Nationalité'),
            EmailField::new('email', 'Adresse email'),
            EmailField::new('lastSchool', 'Dernier établissement fréquenté'),
            EmailField::new('lastDiploma', 'Dernier diplôme'),
            EmailField::new('status', 'Statut'),
            EmailField::new('job', 'Nom et adresse de l\'entreprise'),
            TelephoneField::new('telephone'),

        ];
    }
}
