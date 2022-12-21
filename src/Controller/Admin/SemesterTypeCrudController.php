<?php

namespace App\Controller\Admin;

use App\Entity\SemesterType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SemesterTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SemesterType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
