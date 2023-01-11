<?php

namespace App\Controller\Admin;

use App\Entity\Partner;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class PartnerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Partner::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('label'),
            UrlField::new('url'),
            TextField::new('logoFile')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('logoName')
                ->setBasePath('/uploads/images/partenaires')
                ->setUploadDir('/public/uploads/images/partenaires')
                ->hideOnForm(),
        ];
    }
}
