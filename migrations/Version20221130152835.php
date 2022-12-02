<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130152835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ue DROP FOREIGN KEY FK_2E490A9B4A798B6F');
        $this->addSql('DROP TABLE semester');
        $this->addSql('ALTER TABLE subject ADD level VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_2E490A9B4A798B6F ON ue');
        $this->addSql('ALTER TABLE ue DROP semester_id, DROP code');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE semester (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, level VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, code VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ue ADD semester_id INT DEFAULT NULL, ADD code VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ue ADD CONSTRAINT FK_2E490A9B4A798B6F FOREIGN KEY (semester_id) REFERENCES semester (id)');
        $this->addSql('CREATE INDEX IDX_2E490A9B4A798B6F ON ue (semester_id)');
        $this->addSql('ALTER TABLE subject DROP level');
    }
}
