<?php

namespace App\Controller\Admin;

use App\Entity\UE;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
            NumberField::new('credits'),
            TextField::new('code'),
            AssociationField::new('semester'),
        ];
    }
}
