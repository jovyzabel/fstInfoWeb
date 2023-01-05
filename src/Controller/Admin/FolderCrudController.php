<?php

namespace App\Controller\Admin;

use App\Entity\Folder;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
            TextField::new('attestationOfValidationFile')->setFormType(VichFileType::class)->onlyOnForms(),
            ImageField::new('attestationOfValidation')->setBasePath('public/uploads/documents/')->setUploadDir('public/uploads/documents')->hideOnForm(),
            
            TextField::new('degreeFile')->setFormType(VichFileType::class)->onlyOnForms(),
            ImageField::new('degree')->setBasePath('public/uploads/documents/')->setUploadDir('public/uploads/documents')->hideOnForm(),
            
            TextField::new('bulletinFile')->setFormType(VichFileType::class)->onlyOnForms(),
            ImageField::new('bulletin')->setBasePath('public/uploads/documents/')->setUploadDir('public/uploads/documents')->hideOnForm(),
            
            TextField::new('letter')

        ];
    }
    
}
