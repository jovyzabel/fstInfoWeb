<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210083411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B6E6B5E19');
        $this->addSql('ALTER TABLE semester_ues DROP FOREIGN KEY FK_CA6EA11C3B5A08D7');
        $this->addSql('ALTER TABLE semester_ues DROP FOREIGN KEY FK_CA6EA11C4A798B6F');
        $this->addSql('DROP TABLE semester_ues');
        $this->addSql('DROP INDEX IDX_2E490A9B6E6B5E19 ON ue');
        $this->addSql('ALTER TABLE ue DROP semester_ues_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE semester_ues (id INT AUTO_INCREMENT NOT NULL, semester_id INT DEFAULT NULL, speciality_id INT DEFAULT NULL, INDEX IDX_CA6EA11C4A798B6F (semester_id), INDEX IDX_CA6EA11C3B5A08D7 (speciality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE semester_ues ADD CONSTRAINT FK_CA6EA11C3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE semester_ues ADD CONSTRAINT FK_CA6EA11C4A798B6F FOREIGN KEY (semester_id) REFERENCES semester (id)');
        $this->addSql('ALTER TABLE ue ADD semester_ues_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B6E6B5E19 FOREIGN KEY (semester_ues_id) REFERENCES semester_ues (id)');
        $this->addSql('CREATE INDEX IDX_2E490A9B6E6B5E19 ON ue (semester_ues_id)');
    }
}
