<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title'),
            AssociationField::new('featuredImage'),
            TextEditorField::new('content'),
            SlugField::new('slug')->setTargetFieldName('title')->onlyOnForms()
        ];
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void 
    {
        if (!$entityInstance instanceof Article) return;
        $entityInstance->setAccount($this->getUser());
        parent::persistEntity($entityManager, $entityInstance);
    }
}
