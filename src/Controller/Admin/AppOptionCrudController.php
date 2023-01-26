<?php

namespace App\Controller\Admin;

use App\Entity\AppOption;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AppOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AppOption::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityPermission('ROLE_ADMIN');
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
