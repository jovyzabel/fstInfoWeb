<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210092834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE semester_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE semester ADD semester_type_id INT DEFAULT NULL, DROP level');
        $this->addSql('ALTER TABLE semester ADD CONSTRAINT FK_F7388EED63C5C57C FOREIGN KEY (semester_type_id) REFERENCES semester_type (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7388EED63C5C57C ON semester (semester_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE semester DROP FOREIGN KEY FK_F7388EED63C5C57C');
        $this->addSql('DROP TABLE semester_type');
        $this->addSql('DROP INDEX UNIQ_F7388EED63C5C57C ON semester');
        $this->addSql('ALTER TABLE semester ADD level VARCHAR(255) DEFAULT NULL, DROP semester_type_id');
    }
}
