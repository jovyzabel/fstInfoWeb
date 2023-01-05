<?php

namespace App\Controller\Admin;

use App\Entity\AppOption;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AppOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AppOption::class;
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
