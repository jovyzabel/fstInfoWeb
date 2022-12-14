<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichFileType;

class DocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Document::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('label'),
            TextField::new('documentFile')->setFormType(VichFileType::class)->onlyOnForms(),
            TextField::new('documentName')
                ->setTemplatePath('admin/document/show.html.twig')
                ->hideOnForm(),

            
            DateField::new('createdAt'),

        ];
    }
}
