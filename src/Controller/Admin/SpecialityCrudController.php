<?php

namespace App\Controller\Admin;

use App\Entity\Speciality;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SpecialityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Speciality::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label'),
            TextField::new('code'),
            AssociationField::new('formationCycle'),
            TextEditorField::new('goals'),
            TextEditorField::new('targetedSkills'),
            TextEditorField::new('careers'),
            SlugField::new('slug')->setTargetFieldName('label')->onlyOnForms(),
            // TextEditorField::new('description'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }
}
