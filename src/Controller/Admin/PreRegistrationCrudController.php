<?php

namespace App\Controller\Admin;

use App\Entity\PreRegistration;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PreRegistrationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PreRegistration::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('folder'),
            AssociationField::new('student')
            
        ];
    }

}
