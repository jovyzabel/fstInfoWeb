<?php

namespace App\Controller\Admin;

use App\Entity\Folder;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class FolderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Folder::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('documents')->setTemplatePath('admin/folder/documents.html.twig'),

        ];
    }
    
}
