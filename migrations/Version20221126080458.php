<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221126080458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, ue_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_FBCE3E7A62E883B1 (ue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, diploma VARCHAR(255) NOT NULL, place_of_acquisition VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A62E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A62E883B1');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE ue');
    }
}
