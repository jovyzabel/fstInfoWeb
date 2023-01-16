<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113111450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_option ADD current_academic_year_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_option ADD CONSTRAINT FK_BF856D302B06A9F7 FOREIGN KEY (current_academic_year_id) REFERENCES academic_year (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF856D302B06A9F7 ON app_option (current_academic_year_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_option DROP FOREIGN KEY FK_BF856D302B06A9F7');
        $this->addSql('DROP INDEX UNIQ_BF856D302B06A9F7 ON app_option');
        $this->addSql('ALTER TABLE app_option DROP current_academic_year_id');
    }
}
