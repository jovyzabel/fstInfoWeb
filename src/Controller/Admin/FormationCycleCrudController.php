<?php

namespace App\Controller\Admin;

use App\Entity\FormationCycle;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class FormationCycleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormationCycle::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            ChoiceField::new('label')
                ->setChoices([
                    'Licence' => 'Licence',
                    'Master' => 'Master',
                    'Doctorat' => 'Doctorat',
                    'Certification' => 'Certification'
                ]),
            TextField::new('code'),
            SlugField::new('slug')->setTargetFieldName('label'),
        ];
    }
}
