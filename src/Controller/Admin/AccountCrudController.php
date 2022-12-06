<?php

namespace App\Controller\Admin;

use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountCrudController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $haser){  }

    public static function getEntityFqcn(): string
    {
        return Account::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            EmailField::new('email'),
            ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->renderExpanded()
                ->setChoices([
                    'Administrateur' => 'ROLE_ADMIN',
                    'Redacteur' => 'ROLE_REDACTOR',
                    'Moderateur' => 'ROLE_MODERATOR'
                ]),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Account) return;
        $entityInstance->setPassword($this->haser->hashPassword($entityInstance,'azerty123'));
        parent::persistEntity($entityManager, $entityInstance);
    }

    #[Route('/admin/profile', name : 'app_user_profile')]
    public function FunctionName(): Response
    {
        return $this->render('admin/profile.html.twig', []);
    }
}
