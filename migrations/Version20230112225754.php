<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112225754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumni ADD nationality VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD nationality VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD nationality VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher DROP nationality');
        $this->addSql('ALTER TABLE student DROP nationality');
        $this->addSql('ALTER TABLE alumni DROP nationality');
    }
}
