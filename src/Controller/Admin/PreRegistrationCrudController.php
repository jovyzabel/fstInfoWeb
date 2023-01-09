<?php

namespace App\Controller\Admin;

use App\Entity\PreRegistration;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;

class PreRegistrationCrudController extends AbstractCrudController
{
    public const SHOW = 'show';
    public static function getEntityFqcn(): string
    {
        return PreRegistration::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $showAction = Action::new(self::SHOW, 'Détails')->linkToCrudAction('show');
        return $actions
            ->add(Crud::PAGE_INDEX, $showAction)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DETAIL);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('folder'),
            AssociationField::new('student')
            
        ];
    }

    public function show(AdminContext $adminContext):Response
    {
        return $this->render('admin/pre_registration/details.html.twig', [
            'pre_registration' => $adminContext->getEntity()->getInstance(),
        ]);
    }

}
