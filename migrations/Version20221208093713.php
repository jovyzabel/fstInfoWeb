<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208093713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_cycle (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pre_registration (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semester_ues (id INT AUTO_INCREMENT NOT NULL, semester_id INT DEFAULT NULL, speciality_id INT DEFAULT NULL, INDEX IDX_CA6EA11C4A798B6F (semester_id), INDEX IDX_CA6EA11C3B5A08D7 (speciality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speciality (id INT AUTO_INCREMENT NOT NULL, formation_cycle_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, INDEX IDX_F3D7A08EC27E4693 (formation_cycle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE semester_ues ADD CONSTRAINT FK_CA6EA11C4A798B6F FOREIGN KEY (semester_id) REFERENCES semester (id)');
        $this->addSql('ALTER TABLE semester_ues ADD CONSTRAINT FK_CA6EA11C3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE speciality ADD CONSTRAINT FK_F3D7A08EC27E4693 FOREIGN KEY (formation_cycle_id) REFERENCES formation_cycle (id)');
        $this->addSql('ALTER TABLE ue ADD semester_ues_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B6E6B5E19 FOREIGN KEY (semester_ues_id) REFERENCES semester_ues (id)');
        $this->addSql('CREATE INDEX IDX_2E490A9B6E6B5E19 ON ue (semester_ues_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B6E6B5E19');
        $this->addSql('ALTER TABLE semester_ues DROP FOREIGN KEY FK_CA6EA11C4A798B6F');
        $this->addSql('ALTER TABLE semester_ues DROP FOREIGN KEY FK_CA6EA11C3B5A08D7');
        $this->addSql('ALTER TABLE speciality DROP FOREIGN KEY FK_F3D7A08EC27E4693');
        $this->addSql('DROP TABLE formation_cycle');
        $this->addSql('DROP TABLE pre_registration');
        $this->addSql('DROP TABLE semester_ues');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP INDEX IDX_2E490A9B6E6B5E19 ON ue');
        $this->addSql('ALTER TABLE ue DROP semester_ues_id');
    }
}
