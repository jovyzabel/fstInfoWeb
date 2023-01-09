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
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

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
            TextField::new('name'),
            TextField::new('firstName'),
            DateField::new('birthDay'),
            TextField::new('birthPlace'),
            EmailField::new('email'),
            TextField::new('telephone'),
            TextField::new('civility'),

        ];
    }
    
}
