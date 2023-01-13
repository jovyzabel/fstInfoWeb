<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113110439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_registration ADD academic_year_id INT NOT NULL');
        $this->addSql('ALTER TABLE pre_registration ADD CONSTRAINT FK_A2FEF1B9C54F3401 FOREIGN KEY (academic_year_id) REFERENCES academic_year (id)');
        $this->addSql('CREATE INDEX IDX_A2FEF1B9C54F3401 ON pre_registration (academic_year_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_registration DROP FOREIGN KEY FK_A2FEF1B9C54F3401');
        $this->addSql('DROP INDEX IDX_A2FEF1B9C54F3401 ON pre_registration');
        $this->addSql('ALTER TABLE pre_registration DROP academic_year_id');
    }
}
