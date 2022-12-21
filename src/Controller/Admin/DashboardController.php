<?php

namespace App\Controller\Admin;

use App\Entity\UE;
use App\Entity\Tag;
use App\Entity\Media;
use App\Entity\Alumni;
use App\Entity\Account;
use App\Entity\Article;
use App\Entity\Subject;
use App\Entity\Teacher;
use App\Entity\Category;
use App\Entity\Semester;
use App\Entity\Promotion;
use App\Entity\Speciality;
use App\Entity\SemesterUes;
use App\Entity\SemesterType;
use App\Entity\FormationCycle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FstInfoWeb');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Comptes Utilisateur', 'fa fa-users',Account::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::subMenu('Actualités', 'fa fa-file-text')->setSubItems([
            MenuItem::linkToCrud('Articles', 'fa fa-newspaper',Article::class),
            MenuItem::linkToCrud('Tags', 'fa fa-tags',Tag::class),
            MenuItem::linkToCrud('Categories', 'fa fa-bars-staggered',Category::class),

        ])->setPermission('ROLE_USER');
        yield MenuItem::subMenu('Parcours', 'fa fa-file-text')->setSubItems([
            MenuItem::linkToCrud('Cycles de formation', 'fa fa-books',FormationCycle::class),
            MenuItem::linkToCrud('Specialités', 'fa fa-books',Speciality::class),
            MenuItem::linkToCrud('Semestres', 'fa fa-books',Semester::class),
            MenuItem::linkToCrud('Type de semestre', 'fa fa-books',SemesterType::class),
            MenuItem::linkToCrud('UEs', 'fa fa-books',UE::class),
            MenuItem::linkToCrud('Matières', 'fa fa-book',Subject::class),
            ])->setPermission('ROLE_USER');

        yield MenuItem::linkToCrud('Enseignants', 'fa fa-people-roof',Teacher::class);
        yield MenuItem::linkToCrud('Alumni', 'fa fa-people-roof',Alumni::class);
        yield MenuItem::linkToCrud('Promotions', 'fa fa-people-roof',Promotion::class);

        yield MenuItem::linkToCrud('Media', 'fa fa-photo-film',Media::class)->setPermission('ROLE_USER');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setMenuItems([
                MenuItem::linkToRoute('profile', 'fa fa-user', 'app_user_profile')
            ]);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
