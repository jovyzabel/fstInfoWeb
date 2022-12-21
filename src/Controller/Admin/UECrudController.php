<?php

namespace App\Controller\Admin;

use App\Entity\UE;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class UECrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UE::class;
    }
 
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('label'),
            TextField::new('code'),
            AssociationField::new('semester'),
        ];
    }
}
