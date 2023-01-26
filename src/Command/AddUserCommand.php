<?php

namespace App\Command;

use App\Entity\Account;
use App\Utils\Validator;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:add-user',
    description: 'Permet de creer un utilisateur',
)]
class AddUserCommand extends Command
{

    private SymfonyStyle $io;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private Validator $validator,
        private AccountRepository $accounts
    ) {
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->setHelp($this->getCommandHelp())
            ->addArgument('email', InputArgument::OPTIONAL, 'L\'adresse email de l\'utilisateur')
            ->addArgument('password', InputArgument::OPTIONAL, 'Le mot de passe de l\'utilisateur');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if (null !== $input->getArgument('password') && null !== $input->getArgument('email')) {
            return;
        }

        $this->io->title('Assistant interactif d\'ajout d\'utilisateur');
        $this->io->text([
            'Si vous préférez ne pas utiliser cet assistant interactif, fournissez les',
            'arguments requis par cette commande comme suit :',
            '',
            ' $ php bin/console app:add-user email@example.com password',
            '',
            'Nous allons maintenant vous demander la valeur de tous les arguments de commande manquants.',
        ]);

        // Ask for the email if it's not defined
        $email = $input->getArgument('email');
        if (null !== $email) {
            $this->io->text(' > <info>Email</info>: ' . $email);
        } else {
            $email = $this->io->ask('Email', null, [$this->validator, 'validateEmail']);
            $input->setArgument('email', $email);
        }

        // Ask for the password if it's not defined
        /** @var string|null $password */
        $password = $input->getArgument('password');
        if (null !== $password) {
            $this->io->text(' > <info>Mot de passe</info>: ' . u('*')->repeat(u($password)->length()));
        } else {
            $password = $this->io->askHidden('Mot de passe (Votre saisie sera masquée)', [$this->validator, 'validatePassword']);
            $input->setArgument('password', $password);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('add-user-command');
        
        /** @var string $email */
        $email = $input->getArgument('email');

        /** @var string $plainPassword */
        $plainPassword = $input->getArgument('password');

        // make sure to validate the user data is correct
        $this->validateUserData($email, $plainPassword,);

        // create the user and hash its password
        $account = new Account();
        $account->setEmail($email);
        $account->setRoles(['ROLE_SUPER_ADMIN']);

        $hashedPassword = $this->passwordHasher->hashPassword($account, $plainPassword);
        $account->setPassword($hashedPassword);

        $this->entityManager->persist($account);
        $this->entityManager->flush();

        $this->io->success(sprintf('Le compte a été créer avec succès'));

        $event = $stopwatch->stop('add-user-command');
        if ($output->isVerbose()) {
            $this->io->comment(sprintf('New user database id: %d / Elapsed time: %.2f ms / Consumed memory: %.2f MB', $account->getId(), $event->getDuration(), $event->getMemory() / (1024 ** 2)));
        }

        return Command::SUCCESS;
    }

    private function validateUserData(string $email, string $plainPassword,): void
    {
        // validate password and email if is not this input means interactive.
        $this->validator->validatePassword($plainPassword);
        $this->validator->validateEmail($email);

        // check if a user with the same email already exists.
        $existingEmail = $this->accounts->findOneBy(['email' => $email]);

        if (null !== $existingEmail) {
            throw new RuntimeException(sprintf('There is already a user registered with the "%s" .', $email));
        }
    }

    private function getCommandHelp(): string
    {
        return <<<'HELP'
            La commande <info>%command.name%</info> crée un nouveau compte utilisateur administrateur et l\'enregistre dans la base de données :
              <info>php %command.full_name%</info> <comment>email password</comment>
            Si vous omettez l'un des deux arguments requis, la commande 
            vous demandera de fournir les valeurs manquantes :
              # la commande vous demandera le mot de passe
              <info>php %command.full_name%</info> <comment>email</comment>
              # la commande vous demandera tous les arguments
              <info>php %command.full_name%</info>
            HELP;
    }

    private function validatePassword(?string $plainPassword): string
    {
        if (empty($plainPassword)) {
            throw new InvalidArgumentException('The password can not be empty.');
        }

        if (u($plainPassword)->trim()->length() < 6) {
            throw new InvalidArgumentException('The password must be at least 6 characters long.');
        }

        return $plainPassword;
    }

    private function validateEmail(?string $email): string
    {
        if (empty($email)) {
            throw new InvalidArgumentException('The email can not be empty.');
        }

        if (null === u($email)->indexOf('@')) {
            throw new InvalidArgumentException('The email should look like a real email.');
        }

        return $email;
    }


}
