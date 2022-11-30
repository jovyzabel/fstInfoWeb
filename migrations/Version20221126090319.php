<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221126090319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE teacher ADD account_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D59B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B0F6A6D59B6B5FBA ON teacher (account_id)');
        $this->addSql('ALTER TABLE ue ADD label VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ue DROP label');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D59B6B5FBA');
        $this->addSql('DROP INDEX UNIQ_B0F6A6D59B6B5FBA ON teacher');
        $this->addSql('ALTER TABLE teacher DROP account_id, DROP name, DROP first_name');
    }
}
