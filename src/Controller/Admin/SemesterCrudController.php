<?php

namespace App\Controller\Admin;

use App\Entity\Semester;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SemesterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Semester::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('semesterType'),
            TextField::new('code'),
            AssociationField::new('speciality'),
        ];
    }
}
