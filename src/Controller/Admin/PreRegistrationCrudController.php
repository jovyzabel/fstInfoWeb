<?php

namespace App\Controller\Admin;

use App\Entity\PreRegistration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class PreRegistrationCrudController extends AbstractCrudController
{
    public const SHOW = 'show';
    public const PRINT = 'print';

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    public static function getEntityFqcn(): string
    {
        return PreRegistration::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityPermission('ROLE_ADMIN');
    }

    public function configureActions(Actions $actions): Actions
    {
        $showAction = Action::new(self::SHOW, 'Détails')
            ->linkToRoute('admin_pre_registration_show', function (PreRegistration $preRegistration) {
                return [
                    'id' => $preRegistration->getId()
                ];
            });

        $printAction = Action::new(self::PRINT, 'Imprimer', 'fa fa-file-pdf-o')
            ->linkToRoute('app_pre_registration_approuved')
            ->createAsGlobalAction();

        return $actions
            ->add(Crud::PAGE_INDEX, $printAction)
            ->add(Crud::PAGE_INDEX, $showAction)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DETAIL);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('status', 'Statut'),
            TextField::new('preRegistrationType', 'Type'),
            DateField::new('createdAt', 'Date'),
            AssociationField::new('folder', 'Dossier'),
            AssociationField::new('student', 'Etudiant')

        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('createdAt')
            ->add('status');
    }

    #[Route('/admin/pre-registration/{id}', name: 'admin_pre_registration_show')]
    public function renderPreRegistration(PreRegistration $preRegistration): Response
    {
        return $this->render('admin/pre_registration/details.html.twig', [
            'pre_registration' => $preRegistration,
        ]);
    }
}
