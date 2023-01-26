<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126104157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE academic_year (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, logo_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumni ADD nationality VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_option ADD current_academic_year_id INT DEFAULT NULL, ADD course_leader_id INT DEFAULT NULL, DROP label');
        $this->addSql('ALTER TABLE app_option ADD CONSTRAINT FK_BF856D302B06A9F7 FOREIGN KEY (current_academic_year_id) REFERENCES academic_year (id)');
        $this->addSql('ALTER TABLE app_option ADD CONSTRAINT FK_BF856D30F1B40E78 FOREIGN KEY (course_leader_id) REFERENCES teacher (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF856D302B06A9F7 ON app_option (current_academic_year_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF856D30F1B40E78 ON app_option (course_leader_id)');
        $this->addSql('ALTER TABLE pre_registration ADD academic_year_id INT NOT NULL');
        $this->addSql('ALTER TABLE pre_registration ADD CONSTRAINT FK_A2FEF1B9C54F3401 FOREIGN KEY (academic_year_id) REFERENCES academic_year (id)');
        $this->addSql('CREATE INDEX IDX_A2FEF1B9C54F3401 ON pre_registration (academic_year_id)');
        $this->addSql('ALTER TABLE student ADD nationality VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD nationality VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_option DROP FOREIGN KEY FK_BF856D302B06A9F7');
        $this->addSql('ALTER TABLE pre_registration DROP FOREIGN KEY FK_A2FEF1B9C54F3401');
        $this->addSql('DROP TABLE academic_year');
        $this->addSql('DROP TABLE partner');
        $this->addSql('ALTER TABLE alumni DROP nationality');
        $this->addSql('ALTER TABLE app_option DROP FOREIGN KEY FK_BF856D30F1B40E78');
        $this->addSql('DROP INDEX UNIQ_BF856D302B06A9F7 ON app_option');
        $this->addSql('DROP INDEX UNIQ_BF856D30F1B40E78 ON app_option');
        $this->addSql('ALTER TABLE app_option ADD label VARCHAR(255) DEFAULT NULL, DROP current_academic_year_id, DROP course_leader_id');
        $this->addSql('DROP INDEX IDX_A2FEF1B9C54F3401 ON pre_registration');
        $this->addSql('ALTER TABLE pre_registration DROP academic_year_id');
        $this->addSql('ALTER TABLE student DROP nationality');
        $this->addSql('ALTER TABLE teacher DROP nationality');
    }
}
