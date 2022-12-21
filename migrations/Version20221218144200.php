<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221218144200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumni DROP sexe');
        $this->addSql('ALTER TABLE student DROP sexe');
        $this->addSql('ALTER TABLE teacher DROP sexe');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher ADD sexe VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE student ADD sexe VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE alumni ADD sexe VARCHAR(40) NOT NULL');
    }
}
