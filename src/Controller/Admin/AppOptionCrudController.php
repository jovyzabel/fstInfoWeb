<?php

namespace App\Controller\Admin;

use App\Entity\AppOption;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class AppOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AppOption::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('isPreEnrollPeriod'),
            BooleanField::new('displayCISCOOnCarousel'),
            AssociationField::new('currentAcademicYear'),
            AssociationField::new('courseLeader'),
        ];
    }
}
