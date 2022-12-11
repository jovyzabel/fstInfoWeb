<?php

namespace App\Controller\Admin;

use App\Entity\FormationCycle;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormationCycleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormationCycle::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('label'),
            TextField::new('code'),
        ];
    }
}
