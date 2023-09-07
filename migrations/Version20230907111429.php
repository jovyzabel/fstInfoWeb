<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907111429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_person DROP FOREIGN KEY FK_A44EE6F7F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_A44EE6F7F5B7AF75 ON contact_person');
        $this->addSql('ALTER TABLE contact_person ADD address VARCHAR(255) NOT NULL, DROP address_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_person ADD address_id INT NOT NULL, DROP address');
        $this->addSql('ALTER TABLE contact_person ADD CONSTRAINT FK_A44EE6F7F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A44EE6F7F5B7AF75 ON contact_person (address_id)');
    }
}
